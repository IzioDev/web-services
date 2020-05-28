<?php


namespace SoapClient;


use DateTime;

class Command
{
    /**
     * @var int
     * @ORM\Id()
     */
    public $id;

    /**
     * @var string
     */
    public $status;

    /**
     * @var DateTime
     */
    public $createdAt;

    public function setId($id): self {
        $this->id = $id;

        return $this;
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

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


}