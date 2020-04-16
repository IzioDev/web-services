<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Structure
 *
 * @ApiResource()
 * @ORM\Table(name="structure")
 * @ORM\Entity
 */
class Structure
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
     * @ORM\Column(name="NOM", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="RUE", type="string", length=200, nullable=false)
     */
    private $rue;

    /**
     * @var string
     *
     * @ORM\Column(name="CP", type="string", length=5, nullable=false)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="VILLE", type="string", length=100, nullable=false)
     */
    private $ville;

    /**
     * @var bool
     *
     * @ORM\Column(name="ESTASSO", type="boolean", nullable=false)
     */
    private $estasso;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NB_DONATEURS", type="integer", nullable=true)
     */
    private $nbDonateurs;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NB_ACTIONNAIRES", type="integer", nullable=true)
     */
    private $nbActionnaires;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getEstasso(): ?bool
    {
        return $this->estasso;
    }

    public function setEstasso(bool $estasso): self
    {
        $this->estasso = $estasso;

        return $this;
    }

    public function getNbDonateurs(): ?int
    {
        return $this->nbDonateurs;
    }

    public function setNbDonateurs(?int $nbDonateurs): self
    {
        $this->nbDonateurs = $nbDonateurs;

        return $this;
    }

    public function getNbActionnaires(): ?int
    {
        return $this->nbActionnaires;
    }

    public function setNbActionnaires(?int $nbActionnaires): self
    {
        $this->nbActionnaires = $nbActionnaires;

        return $this;
    }


}
