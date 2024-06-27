<?php

namespace Src\Controllers\Twig;

use Src\Controllers\BaseController;
use Src\Controllers\IBaseController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigController extends BaseController implements IBaseController
{
    public function render(string $view, object|array $params = []): void
    {
        $loader = new FilesystemLoader(__DIR__ . "/../../../views/twig/");
        $twig = new Environment($loader);
        $twig->addGlobal("BASE_URL", env("BASE_URL"));
        try {
            echo $twig->render($view . ".twig.php", $params);
        } catch (\Exception $e) {
            $this->render("error", [
                "errorMessage" => "houve um problema para renderizar a página"
            ]);
        }
        exit;
    }
}