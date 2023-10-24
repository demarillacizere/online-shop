<?php

namespace OnlineShop\Entities;

class Users extends A_Entities
{
    const DB_TABLE_NAME = 'users';
    const DB_TABLE_FIELD_FULL_NAME = 'full_name';
    const DB_TABLE_FIELD_EMAIL = 'email';
    const DB_TABLE_FIELD_PASSWORD = 'password';
    const DB_TABLE_FIELD_ADDRESS = 'address';

    public int $id;
    public string $email;
    public string $fullName;
    public string $password;
    public string $address;


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

    public function findByEmail(string $email): array
    {
        $conn = self::$connection;
        $stmt = $conn->prepare("SELECT * FROM " . self::DB_TABLE_NAME . " WHERE email=:email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

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
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }
    public function insert(array $values): bool
    {
        $conn = self::$connection;
        $stmt = $conn->prepare("INSERT INTO " . self::DB_TABLE_NAME . " (full_name, email, password, address) VALUES (:full_name, :email, :pass, :address)");
        $stmt->bindParam(":full_name", $values[self::DB_TABLE_FIELD_FULL_NAME]);
        $stmt->bindParam(":email", $values[self::DB_TABLE_FIELD_EMAIL]);
        $stmt->bindParam(":pass", $values[self::DB_TABLE_FIELD_PASSWORD]);
        $stmt->bindParam(":address", $values[self::DB_TABLE_FIELD_ADDRESS]);
        $result = $stmt->execute();
        return $result;
    }
}