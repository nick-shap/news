<?php

namespace App\Kernel\Controller;

use App\Kernel\View\View;

abstract class Controller
{
    private View $view;

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function view(string $name, array $data = []): void
    {
        $this->view->show($name, $data);
    }
}