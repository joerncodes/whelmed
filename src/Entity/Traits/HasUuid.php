<?php

namespace App\Entity\Traits;

use Ramsey\Uuid\Uuid;

/**
 * Trait HasUuid
 * @package App\Entity\Traits
 */
trait HasUuid
{
    /**
     * @ORM\Column(type="uuid")
     */
    protected $uuid;

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    /**
     * @ORM\PrePersist
     * @return Uuid
     * @throws \Exception
     */
    public function generateUuid(): Uuid
    {
        if ($this->uuid === null) {
            $this->uuid = Uuid::uuid4();
        }

        return $this->uuid;
    }

    public function setUuid(Uuid $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}
