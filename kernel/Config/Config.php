<?php

namespace App\Kernel\Config;

class Config
{
    public function get(string $key, $default = null): mixed
    {
        $config = require APP_PATH."/config/config.php";

        return $config[$key] ?? $default;
    }
}