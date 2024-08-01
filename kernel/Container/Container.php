<?php

namespace App\Kernel\Container;

use App\Kernel\Http\Request;
use App\Kernel\Router\Route;
use App\Kernel\Router\Router;
use App\Kernel\View\View;

class Container
{
    public readonly Request $request;
    public readonly Router $router;
    public readonly View $view;

    public function __construct()
    {
        $this->initServices();
    }

    private function initServices(): void
    {
        $this->request = Request::init();
        $this->view = new View();
        $this->router = new Router($this->view);
    }
}