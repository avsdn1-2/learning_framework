<?php

namespace Framework\Model;

use Framework\Container\ContainerTrait;

abstract class AbstractModel
{
    use ContainerTrait;

    protected $table;

    public function find(int $id): array
    {
        $sql = sprintf('SELECT * FROM %s WHERE id=:id', $this->table);

        /** @var \PDO $pdo */
        $pdo = $this->get('app.db');

        $query = $pdo->query($sql);
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function findAll(): array
    {
        /** @var \PDO $pdo */
        $pdo = $this->get('app.db');

        $query = $pdo->query('SELECT * FROM '. $this->table);
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $results = [];
        foreach ($result as $item) {
            $results[] = (object) $item;
        }
        return $results;
    }
}