<?php

namespace OnlineShop\Entities;
interface I_Entities
{
    public function findById(int $id): array;

    public function findAll(): array;

    public function insert(array $values): bool;

    public function deleteById(int $id): bool;
}