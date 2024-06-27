<?php

namespace Src\Controllers;

use Src\Controllers\Twig\TwigController;
use Src\Database\Factories\MakeCustomerRepository;
use Src\Helpers\FileHelper;
use Src\Helpers\FormatHelper;

class CustomerController extends TwigController
{
    private function getCustomer($data)
    {
        $customerId = isset($data["customerId"]) ? (int)$data["customerId"] : null;
        $customerRepository = MakeCustomerRepository::make();
        return $customerId ? $customerRepository->findById($customerId) : null;
    }

    public function insertOrUpdate($data): void
    {
        $customer = $this->getCustomer($data);
        $this->render("customer/insert-or-update", [
            "customer" => $customer,
            "title" => $customer ? "Edição de Cliente" : "Cadastro de Cliente"
        ]);
    }

    public function doInsertOrUpdate($data): void
    {
        $customer = $this->getCustomer($data);

        $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $phoneNumber = filter_var($_POST["phone_number"], FILTER_SANITIZE_STRING);
        $phoneNumber = preg_replace('/[^0-9]/i', "", $phoneNumber);

        if (mb_strlen($phoneNumber) < 8 || mb_strlen($phoneNumber) > 11) {
            $this->responseWithJson([
                "status" => 401,
                "message" => "Insira um número de telefone válido!"
            ]);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->responseWithJson([
                "status" => 401,
                "message" => "Insira um e-mail válido!"
            ]);
        }

        $customerRepository = MakeCustomerRepository::make();
        $hasAlreadyCustomerWithSameEmail = $customer ? $customerRepository->findByEmailExceptMine($email, $customer->id) : $customerRepository->findByEmail($email);

        if ($hasAlreadyCustomerWithSameEmail) {
            $this->responseWithJson([
                "status" => 400,
                "message" => "Já existe um cliente com este e-mail"
            ]);
        }

        if (!$customer && !isset($_FILES["file"])) {
            $this->responseWithJson([
                "status" => 400,
                "message" => "Para cadastrar um novo usuário, é preciso inserir uma imagem"
            ]);
        }

        $fileName = $customer ? $customer->image_url : uniqid();
        if ($customer) {
            $fileName = str_replace("uploads/", "", $fileName);
            $fileNameExp = explode(".", $fileName);
            $fileName = $fileNameExp[0];
            $fileExtension = end($fileNameExp);
            if (isset($_FILES["file"])) {
                FileHelper::deleteFile($fileName . "." . $fileExtension);
            }
        }
        if (isset($_FILES["file"])) {
            $file = $_FILES["file"];
            FileHelper::createFile($fileName, $file);
        }

        $imageUrl = isset($_FILES["file"]) ? "uploads/" . $fileName . "." . FileHelper::getFileExtension($_FILES["file"]) : $customer->image_url;
        $customerParams = [
            "name" => $name,
            "email" => $email,
            "phone_number" => $phoneNumber,
            "image_url" => $imageUrl
        ];

        $commit = $customer ? $customerRepository->update((int)$customer->id, $customerParams) : $customerRepository->insert($customerParams);

        if (!$commit) {
            $message = $customer ? "Falha ao alterar cliente" : "Falha ao inserir novo cliente";
            $this->responseWithJson([
                "status" => 500,
                "message" => $message
            ]);
        }

        $message = $customer ? "Cliente alterado com sucesso" : "Cliente inserido com sucesso";
        $this->responseWithJson([
            "status" => 200,
            "message" => $message
        ]);
    }

    public function delete($data): void
    {
        $customerId = (int)$data["customerId"];
        $customerFactory = MakeCustomerRepository::make();
        $customer = $customerFactory->findById($customerId);
        if ($customer) {
            FileHelper::deleteFile(str_replace("uploads/", "", $customer->image_url));
            $customerFactory->delete($customer->id);
        }
        header("Location: " . env("BASE_URL"));
    }

    public function profile($data): void
    {
        $customer = $this->getCustomer($data);

        if (!$customer) {
            header("Location: " . env("BASE_URL"));
        }

        $customer->phone_number_formatted = FormatHelper::phoneFormat($customer->phone_number);
        $this->render("customer/profile", [
            "customer" => $customer
        ]);
    }
}