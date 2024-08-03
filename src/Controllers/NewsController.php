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

    public function show(): void
    {
        $news = $this->db()->find('news', $this->request()->input('id'));

        $this->view('detail', [
            'news' => $news,
        ]);
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

    public function edit()
    {
        $news = $this->db()->find('news', $this->request()->input('id'));

        $this->view('edit', [
            'news' => $news,
        ]);
    }

    public function update()
    {
        $this->db()->update('news', [
            'id' => $this->request()->input('id'),
            'name' => $this->request()->input('name'),
            'preview' => $this->request()->input('preview'),
            'detail' => $this->request()->input('detail'),
        ]);

        $this->redirect('/news/edit?id=' . $this->request()->input('id'));
    }

    public function delete()
    {
        if ($this->db()->delete('news', $this->request()->input('id'))) {
            (new Redirect())->to('/news/');
        }
    }
}