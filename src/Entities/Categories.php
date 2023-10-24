<?php

namespace OnlineShop\Entities;

class Categories extends A_Entities
{
    const DB_TABLE_NAME = 'categories';
    const DB_TABLE_FIELD_NAME = 'name';

    public int $id;
    public string $name;
    public function findById(int $id): array
    {
        $conn = self::$connection;
        $stmt = $conn->prepare("SELECT * FROM " . self::DB_TABLE_NAME . " WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row) {
            return $row;
        } else {
            return [];
        }
    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function insert(array $values): bool
    {
        $conn = self::$connection;
        $stmt = $conn->prepare("INSERT INTO " . self::DB_TABLE_NAME . " (name) VALUES (:name)");
        $stmt->bindParam(":name", $values[self::DB_TABLE_FIELD_NAME]);
        $result = $stmt->execute();
        return $result;
    }
}