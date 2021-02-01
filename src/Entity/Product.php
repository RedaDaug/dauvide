<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $barcode;


    /**
     * @ORM\ManyToOne(targetEntity=MainProduct::class, inversedBy="product")
     */
    private $mainProduct;

    /**
     * @ORM\ManyToOne(targetEntity=AromaList::class, inversedBy="products")
     */
    private $Aroma;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->image_name;
    }

    public function setImageName(?string $image_name): self
    {
        $this->image_name = $image_name;

        return $this;
    }

    public function getBarcode(): ?int
    {
        return $this->barcode;
    }

    public function setBarcode(?int $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getMainProduct(): ?MainProduct
    {
        return $this->mainProduct;
    }

    public function setMainProduct(?MainProduct $mainProduct): self
    {
        $this->mainProduct = $mainProduct;

        return $this;
    }

    public function __toString()
    {
        return $this->image_name;
    }

    public function getAroma(): ?AromaList
    {
        return $this->Aroma;
    }

    public function setAroma(?AromaList $Aroma): self
    {
        $this->Aroma = $Aroma;

        return $this;
    }
}
