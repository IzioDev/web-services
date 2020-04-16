<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * SecteursStructures
 *
 * @ApiResource()
 * @ORM\Table(name="secteurs_structures", indexes={@ORM\Index(name="ID_SECTEUR", columns={"ID_SECTEUR"}), @ORM\Index(name="ID_STRUCTURE", columns={"ID_STRUCTURE"})})
 * @ORM\Entity
 */
class SecteursStructures
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
     * @var \Secteur
     *
     * @ORM\ManyToOne(targetEntity="Secteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_SECTEUR", referencedColumnName="ID")
     * })
     */
    private $idSecteur;

    /**
     * @var \Structure
     *
     * @ORM\ManyToOne(targetEntity="Structure")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_STRUCTURE", referencedColumnName="ID")
     * })
     */
    private $idStructure;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSecteur(): ?Secteur
    {
        return $this->idSecteur;
    }

    public function setIdSecteur(?Secteur $idSecteur): self
    {
        $this->idSecteur = $idSecteur;

        return $this;
    }

    public function getIdStructure(): ?Structure
    {
        return $this->idStructure;
    }

    public function setIdStructure(?Structure $idStructure): self
    {
        $this->idStructure = $idStructure;

        return $this;
    }


}
