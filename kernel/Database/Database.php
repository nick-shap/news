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

    private function connect(): void
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

    public function find(string $table, int $id): array|bool
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

    public function update(string $table, array $data): bool
    {
        $fields = array_keys($data);

        $set = implode(', ', array_map(fn ($field) => "$field = :$field", $fields));

        $sql = "UPDATE $table SET $set WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $exception) {
            return false;
        }

        return true;
    }

    public function paginated(string $table, int $page): array|bool
    {
        $result = [];

        $sql = "SELECT count(id) FROM $table";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute();
        } catch (\PDOException $exception) {
            return false;
        }

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $result['total'] = $row['count(id)'];
        }

        $result['count_pages'] = ceil($result['total'] / 5);

        $offset = ($page - 1) * 5;

        $result['current_page'] = $page;

        $sql = "SELECT * FROM $table LIMIT 5 OFFSET $offset";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute();
        } catch (\PDOException $exception) {
            return false;
        }

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $result['items'][] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'preview' => $row['preview'],
                'detail' => $row['detail'],
            ];
        }

        return $result;
    }
}