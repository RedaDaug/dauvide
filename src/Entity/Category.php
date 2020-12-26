<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private $image_name;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="category")
     */
    private $products;


    /**
     * @ORM\OneToMany(targetEntity=MainProduct::class, mappedBy="category")
     */
    private $mainProducts;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->groups = new ArrayCollection();
        $this->mainProducts = new ArrayCollection();
    }

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

    public function getImageName(): ?string
    {
        return $this->image_name;
    }

    public function setImageName(?string $image_name): self
    {
        $this->image_name = $image_name;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|MainProduct[]
     */
    public function getMainProducts(): Collection
    {
        return $this->mainProducts;
    }

    public function addMainProduct(MainProduct $mainProduct): self
    {
        if (!$this->mainProducts->contains($mainProduct)) {
            $this->mainProducts[] = $mainProduct;
            $mainProduct->setCategory($this);
        }

        return $this;
    }

    public function removeMainProduct(MainProduct $mainProduct): self
    {
        if ($this->mainProducts->removeElement($mainProduct)) {
            // set the owning side to null (unless already changed)
            if ($mainProduct->getCategory() === $this) {
                $mainProduct->setCategory(null);
            }
        }

        return $this;
    }
}
