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
        $fields = array_keys($data);

        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(fn ($field) => ":$field", $fields));

        $sql = "INSERT INTO $table ($columns) VALUES ($binds)";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $exception) {
            return false;
        }

        return (int) $this->pdo->lastInsertId();
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

    public function all(string $table): array
    {

        $result = [];

        $sql = "SELECT * FROM $table";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $result[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'preview' => $row['preview'],
                'detail' => $row['detail'],
            ];
        }

        return $result;
    }
}