<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\Redirect;
use App\Kernel\View\View;

class NewsController extends Controller
{
    public function index(): void
    {
        $news = $this->db()->all('news');

        $this->view('home', [
            'news' => $news,
        ]);
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
        $this->db()->save('news', [
            'name' => $this->request()->input('name'),
            'preview' => $this->request()->input('preview'),
            'detail' => $this->request()->input('detail'),
        ]);
        (new Redirect())->to('/news/');
    }

    public function update($id)
    {
    }

    public function delete($id)
    {
    }
}