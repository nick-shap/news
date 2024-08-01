<?php

namespace App\Kernel\View;

class View
{
    public function show(string $name, array $data = []): void
    {

        $viewPath = APP_PATH."/views/$name.php";

        if (! file_exists($viewPath)) {
            echo "View $name does not exist";
            exit();
        }

        extract($data);

        include_once $viewPath;
    }

}