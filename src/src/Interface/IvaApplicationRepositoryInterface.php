<?php

namespace App\Interface;

use App\Entity\IvaApplication;

Interface IvaApplicationRepositoryInterface
{
    public function getAll(): ?array;
    public function getById(int $id): ?IvaApplication;
    public function update();
    public function delete();
}