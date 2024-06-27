<?php

use CoffeeCode\Router\Router;
use Dotenv\Dotenv;
use Src\Core\Connection;

date_default_timezone_set('America/Sao_Paulo');
require_once "./vendor/autoload.php";

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

Connection::getConnection();

$router = new Router(env("BASE_URL"));
$router->namespace("Src\\Controllers");

$router->group(null);
$router->get("/", "HomeController:index");

$router->get("/migrate", "HomeController:migrate");
$router->post("/migrate", "HomeController:migrate");

$router->group("customer");
$router->get("/insert", "CustomerController:insertOrUpdate");
$router->post("/insert", "CustomerController:doInsertOrUpdate");
$router->get("/edit/{customerId}", "CustomerController:insertOrUpdate");
$router->post("/edit/{customerId}", "CustomerController:doInsertOrUpdate");
$router->get("/delete/{customerId}", "CustomerController:delete");
$router->get("/profile/{customerId}", "CustomerController:profile");

$router->group("error");
$router->get("/{errorCode}", "HomeController:error");

try {
    $router->dispatch();
} catch (\Exception $e) {
    $router->redirect("error/500");
}

if ($router->error()) {
    $router->redirect("/error/{$router->error()}");
}