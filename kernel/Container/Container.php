<?php

namespace App\Kernel\Container;

use App\Kernel\Http\Redirect;
use App\Kernel\Http\Request;
use App\Kernel\Router\Route;
use App\Kernel\Router\Router;
use App\Kernel\View\View;

class Container
{
    public readonly Request $request;
    public readonly Router $router;
    public readonly View $view;
    public readonly Redirect $redirect;

    public function __construct()
    {
        $this->initServices();
    }

    private function initServices(): void
    {
        $this->request = Request::init();
        $this->view = new View();
        $this->redirect = new Redirect();
        $this->router = new Router($this->view, $this->request, $this->redirect);
    }
}