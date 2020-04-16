<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Secteur
 *
 * @ApiResource()
 * @ORM\Table(name="secteur", uniqueConstraints={@ORM\UniqueConstraint(name="LIBELLE", columns={"LIBELLE"})})
 * @ORM\Entity
 */
class Secteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLE", type="string", length=100, nullable=false)
     */
    private $libelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }
}
