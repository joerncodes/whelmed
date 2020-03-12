<?php

namespace App\Domain\Query\Project;

use App\Entity\Project;
use App\Domain\Project\ProjectList;

class All extends Base
{
    public function getProjectList(): ProjectList
    {
        return $this->executeQuery(
            $this->queryBuilder->select('p')
                ->from(Project::class, 'p')
        );
    }
}
