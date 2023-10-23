<?php

namespace OnlineShop\Entities;
class OrderItems extends A_Entities
{
    const DB_TABLE_NAME = 'order_items';

    const DB_TABLE_FIELD_ORDERID = 'order_id';
    const DB_TABLE_FIELD_PRODUCTID = 'product_id';
    const DB_TABLE_FIELD_QUANTITY = 'order_quantity';
    const DB_TABLE_FIELD_TOTALPRICE = 'total_price';

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
        $stmt = $conn->prepare("INSERT INTO " . self::DB_TABLE_NAME . " (order_id, product_id, order_quantity, total_price) VALUES (:order_id, :product_id, :quantity, :total_price)");
        $stmt->bindParam(":order_id", $values[self::DB_TABLE_FIELD_ORDERID]);
        $stmt->bindParam(":product_id", $values[self::DB_TABLE_FIELD_PRODUCTID]);
        $stmt->bindParam(":quantity", $values[self::DB_TABLE_FIELD_QUANTITY]);
        $stmt->bindParam(":total_price", $values[self::DB_TABLE_FIELD_TOTALPRICE]);
        $result = $stmt->execute();
        return $result;
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