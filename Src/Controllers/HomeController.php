<?php

namespace Src\Controllers;

use Src\Controllers\Twig\TwigController;
use Src\Database\Factories\MakeCustomerRepository;
use Src\Database\Migrations\Handle;

class HomeController extends TwigController
{
    public function index(): void
    {
        $customer = MakeCustomerRepository::make();
        $this->render("home", [
            "title" => "Página inicial",
            "customers" => $customer->getAll()
        ]);
    }

    public function error($data): void
    {
        $errorCode = (int)$data["errorCode"];
        $this->render("error", [
            "title" => "Erro: " . $errorCode,
            "errorMessage" => "Houve um problema para carregar esta página"
        ]);
    }

    public function migrate(): void
    {
        try {
            Handle::up();
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $this->responseWithJson([
                    "message" => "migrations realizadas com sucesso"
                ]);
            }
            $this->render("migrate", [
                "migrateMessage" => "Migrations foram realizadas com sucesso!"
            ]);
        } catch (\Exception $e) {
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $this->responseWithJson([
                    "message" => "houve um problema ao realizar as migrations",
                    "error" => $e->getMessage(),
                ]);
            }
            $this->render("error", [
                "errorMessage" => $e->getMessage()
            ]);
        }
    }
}