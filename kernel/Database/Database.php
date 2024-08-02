<?php

namespace App\Kernel\Database;

use App\Kernel\Config\Config;

class Database
{
    private \PDO $pdo;

    public function __construct(
        private Config $config,
    )
    {
        $this->connect();
    }

    private function connect()
    {
        $path = $this->config->get('DB_PATH');

        try {
            $this->pdo = new \PDO("sqlite:" . $path);
        } catch (\PDOException $exception) {
            exit($exception->getMessage());
        }

    }

    public function save(string $table, array $data): int|false
    {

    }

    public function delete(string $table, int $id)
    {

    }

    public function find(string $table, int $id)
    {

    }

    public function paginated(string $table, $limit, $offset)
    {

    }

    public function all(string $table)
    {

    }
}