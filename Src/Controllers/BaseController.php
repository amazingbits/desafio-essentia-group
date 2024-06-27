<?php

namespace Src\Controllers;

abstract class BaseController
{
    protected function responseWithJson(array|object $data, int $code = 200): void
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST");
        header("Access-Control-Allow-Headers: X-Requested-With");
        header("Content-Type: application/json; charset=utf-8");

        http_response_code($code);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
}