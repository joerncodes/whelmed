<?php

namespace App\Domain\Project;

use App\Entity\Project;
use Webmozart\Assert\Assert;

class ProjectList
{
    private $projects = [];


    public function __construct(array $projects)
    {
        Assert::allIsInstanceOf($projects, Project::class);
        $this->projects = $projects;
    }

    public function getProjects(): array
    {
        return $this->projects;
    }
}
