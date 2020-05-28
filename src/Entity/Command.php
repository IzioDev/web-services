<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiSubresource;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ApiFilter(DateFilter::class, properties={"createdAt"})
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "status": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"createdAt": "ASC"})
 * @ORM\Entity(repositoryClass="App\Repository\CommandRepository")
 */
class Command
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @var DateTime
     * @Assert\NotBlank
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commands", cascade={"persist"})
     */
    private $user;

    /**
     * @var CommandLine
     * @ORM\OneToMany(targetEntity="App\Entity\CommandLine", mappedBy="command", orphanRemoval=true, cascade={"persist"})
     * @ApiSubresource
     */
    private $commandLines;

    public function __construct()
    {
        $this->commandLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|CommandLine[]
     */
    public function getCommandLines(): Collection
    {
        return $this->commandLines;
    }

    public function addCommandLine(CommandLine $commandLine): self
    {
        if (!$this->commandLines->contains($commandLine)) {
            $this->commandLines[] = $commandLine;
            $commandLine->setCommand($this);
        }

        return $this;
    }

    public function removeCommandLine(CommandLine $commandLine): self
    {
        if ($this->commandLines->contains($commandLine)) {
            $this->commandLines->removeElement($commandLine);
            // set the owning side to null (unless already changed)
            if ($commandLine->getCommand() === $this) {
                $commandLine->setCommand(null);
            }
        }

        return $this;
    }

    public function getTotalPrice(): float {
        $total = 0;
        foreach ($this->getCommandLines() as $commandLine) {
            $total += $commandLine->getPrice() * $commandLine->getQuantity();
        }

        return $total;
    }
}
