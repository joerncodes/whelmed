<?php

namespace App\Entity\Traits;

trait IsCreated
{
    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdDate;

    /**
     * @ORM\PrePersist
     * @return Uuid
     * @throws \Exception
     */
    public function generateCreated(): \DateTimeInterface
    {
        if ($this->createdDate === null) {
            $this->createdDate = new \DateTime();
        }

        return $this->createdDate;
    }

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
