<?php

namespace App\Domain\ViewParameters;

use App\Domain\Project\ProjectList;
use App\Domain\Query\Project\All;
use Symfony\Component\Security\Core\Security;

class ProjectsViewParameter
{
    /**
     * @var All
     */
    private $allQuery;
    private $projectList;

    public function __construct(All $allQuery, Security $security)
    {
        $this->projectList = $security->getUser() !== null
            ? $allQuery->getProjectList()
            : new ProjectList([]);
    }

    public function getProjects()
    {
        return $this->projectList->getProjects();
    }
}
