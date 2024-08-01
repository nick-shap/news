<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Request;
use App\Kernel\View\View;

abstract class Controller
{
    private View $view;
    private Request $request;

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
}