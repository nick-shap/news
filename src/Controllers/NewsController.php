<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\View\View;

class NewsController extends Controller
{
    public function index(): void
    {
        $this->view('home');
    }

    public function show($id): void
    {
        $this->view('detail');
    }

    public function create(): void
    {
        $this->view('create');
    }

    public function store()
    {
        echo "store";
    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}