<?php

namespace App\Entity;

use App\Repository\IvaApplicationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IvaApplicationRepository::class)]
class IvaApplication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $code = null;

    #[ORM\Column(length: 50)]
    private ?string $ivaApplication = null;

    #[ORM\Column(nullable: true)]
    private ?float $aliquot = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getIvaApplication(): ?string
    {
        return $this->ivaApplication;
    }

    public function setIvaApplication(string $ivaApplication): static
    {
        $this->ivaApplication = $ivaApplication;

        return $this;
    }

    public function getAliquot(): ?float
    {
        return $this->aliquot;
    }

    public function setAliquot(?float $aliquot): static
    {
        $this->aliquot = $aliquot;

        return $this;
    }
}
