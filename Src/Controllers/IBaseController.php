<?php

namespace Src\Controllers;

interface IBaseController
{
    public function render(string $view, array|object $params = []): void;
}