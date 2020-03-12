<?php

namespace App\Domain\Query\Project;

use App\Domain\Project\ProjectList;
use App\Domain\Task\TaskList;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Security;

abstract class Base
{
    /**
     * @var QueryBuilder
     */
    protected $queryBuilder;

    /**
     * @var User
     */
    protected $user;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->queryBuilder = $em->createQueryBuilder();
        $this->user = $security->getUser();
    }

    protected function executeQuery(QueryBuilder $queryBuilder): ProjectList
    {
        $result = $queryBuilder->andWhere(
            $queryBuilder->expr()->eq('p.user', $this->user->getId())
        )
            ->orderBy('p.title', 'ASC')
            ->getQuery()
            ->getResult();

        return new ProjectList($result);
    }

    abstract public function getProjectList(): ProjectList;
}
