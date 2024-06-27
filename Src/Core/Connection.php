<?php

namespace Src\Core;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Connection
{
    public static function getConnection(): void
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            "driver" => env("DB_DRIVER"),
            "host" => env("DB_HOST"),
            "database" => env("DB_NAME"),
            "username" => env("DB_USER"),
            "password" => env("DB_PASSWORD"),
            "port" => env("DB_PORT"),
            "charset" => "utf8",
            "collation" => "utf8_unicode_ci",
        ]);
        $capsule->setEventDispatcher(new Dispatcher(new Container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}