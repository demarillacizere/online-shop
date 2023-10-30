<?php

namespace OnlineShop\Entities;

class Cart extends A_Entities
{
    const DB_TABLE_NAME = 'cart';

    const DB_TABLE_FIELD_ID = 'id';
    const DB_TABLE_FIELD_USERID = 'user_id';
    const DB_TABLE_FIELD_PRODUCT = 'product_id';
    const DB_TABLE_FIELD_QNT = 'order_quantity';
    const DB_TABLE_FIELD_TOTALPRICE = 'total_price';

    public int $id;
    public int $userId;
    public int $productId;
    public int $quantity;
    public int $totalPrice;

    public function findById(int $id): array
    {
        $conn = self::$connection;
        $stmt = $conn->prepare("SELECT * FROM " . self::DB_TABLE_NAME . " WHERE id=:id");
        $stmt->bindParam(":id", $id);
        $result = [];
        $stmt->execute();
        foreach ($stmt as $row) {
            $result[] = $row;
        }

        return $result;
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
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getQnt(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQnt(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function insert(array $values): bool
    {
        $conn = self::$connection;
        $stmt = $conn->prepare("INSERT INTO " . self::DB_TABLE_NAME . " (user_id, product_id, order_quantity, total_price) VALUES (:user_id, :product_id, :quantity, :total_price)");
        $stmt->bindParam(":user_id", $values[self::DB_TABLE_FIELD_USERID]);
        $stmt->bindParam(":product_id", $values[self::DB_TABLE_FIELD_PRODUCT]);
        $stmt->bindParam(":quantity", $values[self::DB_TABLE_FIELD_QNT]);
        $stmt->bindParam(":total_price", $values[self::DB_TABLE_FIELD_TOTALPRICE]);
        $result = $stmt->execute();
        return $result;
    }

    public function update(int $id, array $values): bool
    {
        $conn = self::$connection;
        $stmt = $conn->prepare("UPDATE " . self::DB_TABLE_NAME . " SET order_quantity=:quantity, total_price=:total_price WHERE id=:id");
        $stmt->bindParam(":total_price", $values[self::DB_TABLE_FIELD_TOTALPRICE]);
        $stmt->bindParam(":quantity", $values[self::DB_TABLE_FIELD_QNT]);
        $stmt->bindParam(":id", $id);
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