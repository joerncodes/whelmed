<?php

namespace App\Entity\Traits;

trait IsCompleted
{
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $completedDate;

    public function getCompletedDateString(): ?string
    {
        if($this->completedDate === null) {
            return 'Not completed';
        }

        return $this->completedDate->format('Y-m-d H:i:s');
    }

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
