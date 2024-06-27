<?php

namespace Src\Database\Factories;

use Src\Database\Entities\Customer;
use Src\Database\Repositories\CustomerRepository;

class MakeCustomerRepository
{
    public static function make(): CustomerRepository
    {
        $customer = new Customer();
        return new CustomerRepository($customer);
    }
}