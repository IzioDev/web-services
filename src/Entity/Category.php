<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ApiFilter(OrderFilter::class, properties={"id": "ASC"})
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "label": "exact", "description": "partial"})
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @Assert\Length(max="255", maxMessage="The label cannot be longer than {{ limit }} characters")
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min="10", minMessage="The description must be at least {{ limit }} characters long")
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @Assert\NotBlank
     * @Assert\Url
     * @ORM\Column(type="text")
     */
    private $imageUri;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="category")
     * @ApiSubresource
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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImageUri(): ?string
    {
        return $this->imageUri;
    }

    public function setImageUri(string $imageUri): self
    {
        $this->imageUri = $imageUri;

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
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

        return $this;
    }
}
