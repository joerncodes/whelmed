<?php

namespace App\Domain\Query\Task;

use App\Domain\Task\TaskList;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Security;

abstract class Base implements QueryInterface
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

    protected function executeQuery(QueryBuilder $queryBuilder): TaskList
    {
        $result = $queryBuilder->andWhere(
            $queryBuilder->expr()->eq('t.user', $this->user->getId())
        )
            ->orderBy('t.title', 'ASC')
            ->getQuery()
            ->getResult();

        return new TaskList($result);
    }

    abstract public function getTaskList(): TaskList;
}
