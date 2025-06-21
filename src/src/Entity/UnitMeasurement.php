<?php

namespace App\Entity;

use App\Repository\UnitMeasurementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UnitMeasurementRepository::class)]
class UnitMeasurement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    private ?string $code = null;

    #[ORM\Column(length: 50)]
    private ?string $UnitOfMeasurement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getUnitOfMeasurement(): ?string
    {
        return $this->UnitOfMeasurement;
    }

    public function setUnitOfMeasurement(string $UnitOfMeasurement): static
    {
        $this->UnitOfMeasurement = $UnitOfMeasurement;

        return $this;
    }
}
