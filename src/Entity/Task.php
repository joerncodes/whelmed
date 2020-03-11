<?php

namespace App\Entity;

use App\Entity\Traits\HasUuid;
use App\Entity\Traits\IsCompleted;
use App\Entity\Traits\IsCreated;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Task extends Base
{
    use HasUuid, IsCreated, IsCompleted;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="tasks")
     */
    private $project;

    /**
     * @ORM\Column(type="boolean")
     */
    private $flagged = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function isFlagged(): ?bool
    {
        return $this->flagged;
    }

    public function setFlagged(bool $flagged): self
    {
        $this->flagged = $flagged;

        return $this;
    }
}
