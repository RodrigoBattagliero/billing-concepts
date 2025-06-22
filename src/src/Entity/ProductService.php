<?php

namespace App\Entity;

use App\Repository\ProductServiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductServiceRepository::class)]
class ProductService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1)]
    private ?string $type = null;

    #[ORM\ManyToOne]
    private ?Category $category = null;

    #[Assert\Regex(pattern: '/^[a-zA-Z0-9]+$/')]
    #[ORM\Column(length: 20, unique: true)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $productService = null;

    #[ORM\ManyToOne]
    private ?UnitMeasurement $unitMeasurement = null;

    #[ORM\ManyToOne]
    private ?IvaApplication $ivaApplication = null;

    #[ORM\Column(nullable: true)]
    private ?float $grossPrice = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
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

    public function getProductService(): ?string
    {
        return $this->productService;
    }

    public function setProductService(string $productService): static
    {
        $this->productService = $productService;

        return $this;
    }

    public function getUnitMeasurement(): ?UnitMeasurement
    {
        return $this->unitMeasurement;
    }

    public function setUnitMeasurement(?UnitMeasurement $unitMeasurement): static
    {
        $this->unitMeasurement = $unitMeasurement;

        return $this;
    }

    public function getIvaApplication(): ?IvaApplication
    {
        return $this->ivaApplication;
    }

    public function setIvaApplication(?IvaApplication $ivaApplication): static
    {
        $this->ivaApplication = $ivaApplication;

        return $this;
    }

    public function getGrossPrice(): ?float
    {
        return $this->grossPrice;
    }

    public function setGrossPrice(?float $grossPrice): static
    {
        $this->grossPrice = $grossPrice;

        return $this;
    }
}
