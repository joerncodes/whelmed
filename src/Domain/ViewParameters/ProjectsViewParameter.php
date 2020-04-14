<?php

namespace App\Domain\ViewParameters;

use App\Domain\Project\ProjectList;
use App\Domain\Query\Project\All;

class ProjectsViewParameter
{
    /**
     * @var All
     */
    private $allQuery;
    private $projectList;

    public function __construct(All $allQuery)
    {
        $this->projectList = $allQuery->getProjectList();
    }

    public function getProjects()
    {
        return $this->projectList->getProjects();
    }
}
