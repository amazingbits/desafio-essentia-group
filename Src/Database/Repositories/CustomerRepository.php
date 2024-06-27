<?php

namespace Src\Database\Repositories;

use Src\Database\Entities\Customer;

class CustomerRepository
{
    private Customer $customer;

    public function __construct(
        Customer $customer
    )
    {
        $this->customer = $customer;
    }

    public function getAll()
    {
        return $this->customer->orderBy("name", "ASC")->get();
    }

    public function findById(int $id)
    {
        return $this->customer->where("id", $id)->first();
    }

    public function findByEmail(string $email)
    {
        return $this->customer->where("email", $email)->first();
    }

    public function findByEmailExceptMine(string $email, int $id)
    {
        return $this->customer->where([
            ["email", "=", $email],
            ["id", "<>", $id]
        ])->first();
    }

    public function insert(array $params): bool
    {
        $customer = new Customer();
        $customer->name = $params["name"];
        $customer->email = $params["email"];
        $customer->phone_number = $params["phone_number"];
        $customer->image_url = $params["image_url"];
        return $customer->save();
    }

    public function update(int $id, array $params): bool
    {
        $customer = $this->findById($id);
        $customer->name = $params["name"];
        $customer->email = $params["email"];
        $customer->phone_number = $params["phone_number"];
        $customer->image_url = $params["image_url"];
        return $customer->save();
    }

    public function delete(int $id): bool
    {
        $customer = $this->findById($id);
        return $customer->delete();
    }
}