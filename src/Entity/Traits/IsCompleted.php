<?php

namespace App\Entity\Traits;

trait IsCompleted
{
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $completedDate;

    public function getCompletedDate(): ?\DateTimeInterface
    {
        return $this->completedDate;
    }

    public function setCompletedDate(\DateTimeInterface $completedDate = null): self
    {
        $this->completedDate = $completedDate;

        return $this;
    }

    public function isCompleted(): bool
    {
        return $this->completedDate !== null;
    }
}
