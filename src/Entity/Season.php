<?php

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeasonRepository::class)
 */
class Season
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
     * @ORM\OneToMany(targetEntity=MainProduct::class, mappedBy="season")
     */
    private $mainProducts;

    public function __construct()
    {
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
            $mainProduct->setSeason($this);
        }

        return $this;
    }

    public function removeMainProduct(MainProduct $mainProduct): self
    {
        if ($this->mainProducts->removeElement($mainProduct)) {
            // set the owning side to null (unless already changed)
            if ($mainProduct->getSeason() === $this) {
                $mainProduct->setSeason(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
