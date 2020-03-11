<?php

namespace App\Entity\Traits;

trait IsCreated
{
    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdDate;

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }
}
