<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ApiResource()
 * @ApiFilter(OrderFilter::class, properties={"quantity": "ASC", "price": "ASC"})
 * @ORM\Entity(repositoryClass="App\Repository\CommandLineRepository")
 */
class CommandLine
{
    /**
     * @Assert\NotBlank
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="commandLines", cascade={"persist"})
     * @ORM\Id @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Command", inversedBy="commandLines", cascade={"persist"})
     * @ORM\Id @ORM\JoinColumn(nullable=false)
     */
    private $command;

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getCommand(): ?Command
    {
        return $this->command;
    }

    public function setCommand(?Command $command): self
    {
        $this->command = $command;

        return $this;
    }
}
