<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\Redirect;
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
        (new Redirect())->to('/news/');
        //echo $this->request()->input('name');
    }

    public function update($id)
    {
    }

    public function delete($id)
    {
    }
}