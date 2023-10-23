<?php

namespace OnlineShop\Entities;
class Orders extends A_Entities
{
    const DB_TABLE_NAME = 'orders';

    const DB_TABLE_FIELD_ID = 'id';
    const DB_TABLE_FIELD_USERID = 'user_id';
    const DB_TABLE_FIELD_TOTALAMOUNT = 'total_amount';

    public int $id;
    public int $userId;
    public int $totalAmount;
    public int $isPayed;
    public function findById(int $id): array
    {
        // TODO: Implement findById() method.
    }

    public function findAllById(int $id): array
    {
        // TODO: Implement findAllById() method.
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
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return bool
     */
    public function isPayed(): bool
    {
        return $this->isPayed;
    }

    /**
     * @param bool $isPayed
     */
    public function setIsPayed(bool $isPayed): void
    {
        $this->isPayed = $isPayed;
    }

    public function insert(array $values): bool
    {
        $conn = self::$connection;
        $stmt = $conn->prepare("INSERT INTO " . self::DB_TABLE_NAME . " (user_id, total_amount) VALUES (:user_id, :total_amount)");
        $stmt->bindParam(":user_id", $values[self::DB_TABLE_FIELD_USERID]);
        $stmt->bindParam(":total_amount", $values[self::DB_TABLE_FIELD_TOTALAMOUNT]);
        $result = $stmt->execute();
    
        if ($result) {
            $orderId = $conn->lastInsertId();
            $_SESSION["order_id"] = $orderId;
            return true;
        }
    
        return false;
    }
    

    public function findAllByUserId(int $userId): array
    {
        $conn = self::$connection;
        $stmt = $conn->prepare("SELECT * FROM " . self::DB_TABLE_NAME . " WHERE user_id=" . $userId);
        $result = [];
        $stmt->execute();
        foreach ($stmt as $row) {
            $result[] = $row;
        }
        return $result;
    }

    public function findAllByUserIdJoinWithProducts(int $userId): array
    {
        $conn = self::$connection;
        $stmt = $conn->prepare("SELECT cart.*, products.name, products.quantity, products.image,products.price FROM " . self::DB_TABLE_NAME . " JOIN products ON cart.product_id=products.id WHERE user_id=" . $userId);
        $result = [];
        $stmt->execute();
        foreach ($stmt as $row) {
            $result[] = $row;
        }
        return $result;
    }

    public function deleteByProductId(int $id): bool
    {
        $conn = self::$connection;
        $stmt = $conn->prepare("DELETE FROM " . self::DB_TABLE_NAME . " WHERE product_id=:product_id AND user_id=:user_id");
        $stmt->bindParam(":product_id", $id);
        $stmt->bindParam(":user_id", $_SESSION['user']['id']);
        $result = $stmt->execute();
        return $result;
    }
}