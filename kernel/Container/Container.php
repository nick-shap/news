<?php

namespace App\Kernel\Container;

use App\Kernel\Config\Config;
use App\Kernel\Database\Database;
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
    public readonly Config $config;
    public readonly Database $database;

    public function __construct()
    {
        $this->initServices();
    }

    private function initServices(): void
    {
        $this->request = Request::init();
        $this->view = new View();
        $this->redirect = new Redirect();
        $this->config = new Config();
        $this->database = new Database($this->config);
        $this->router = new Router($this->view, $this->request, $this->redirect);
    }
}