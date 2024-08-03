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

    public function delete(string $table, int $id): bool
    {

        $sql = "DELETE FROM $table WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute([$id]);
        } catch (\PDOException $exception) {
            return false;
        }

        return true;
    }

    public function find(string $table, int $id)
    {
        $result = [];

        $sql = "SELECT * FROM $table WHERE id = ? LIMIT 1";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute([$id]);
        } catch (\PDOException $exception) {
            return false;
        }

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $result = [
                'id' => $row['id'],
                'name' => $row['name'],
                'preview' => $row['preview'],
                'detail' => $row['detail'],
            ];
        }

        return $result;
    }

    public function paginated(string $table, $offset)
    {

    }

    public function all(string $table): array
    {

        $result = [];

        $sql = "SELECT * FROM $table";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute();
        } catch (\PDOException $exception) {
            return false;
        }

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