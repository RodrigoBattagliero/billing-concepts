<?php

namespace App\Service;

use App\Interface\IvaApplicationRepositoryInterface;

class IvaApplication
{
    public function __construct(
        private IvaApplicationRepositoryInterface $repository
    ) {}


    public function getAll(): ?array
    {
        return $this->repository->getAll();
    }
}