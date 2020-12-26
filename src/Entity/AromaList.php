<?php

namespace App\Entity;

use App\Repository\AromaListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AromaListRepository::class)
 */
class AromaList
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
    private $Aroma;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="Aroma")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAroma(): ?string
    {
        return $this->Aroma;
    }

    public function setAroma(string $Aroma): self
    {
        $this->Aroma = $Aroma;

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
            $product->setAroma($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getAroma() === $this) {
                $product->setAroma(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Aroma;
    }
}
