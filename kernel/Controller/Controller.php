<?php

namespace App\Kernel\Controller;

use App\Kernel\Database\Database;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\Request;
use App\Kernel\View\View;

abstract class Controller
{
    private View $view;
    private Request $request;
    private Redirect $redirect;
    private Database $database;

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function view(string $name, array $data = []): void
    {
        $this->view->show($name, $data);
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function request(): Request
    {
        return $this->request;
    }

    public function setRedirect(): void
    {
        $this->redirect = new Redirect();
    }

    public function redirect(string $url): Redirect
    {
        return $this->redirect->to($url);
    }

    public function setDatabase(Database $database): void
    {
        $this->database = $database;
    }

    public function db(): Database
    {
        return $this->database;
    }
}