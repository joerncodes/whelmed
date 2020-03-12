<?php

namespace App\Domain\Query\Task;

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
    /**
     * @var TaskList
     */
    private $taskList;

    public function __construct(EntityManagerInterface $em, Security $security, TaskList $taskList)
    {
        $this->queryBuilder = $em->createQueryBuilder();
        $this->user = $security->getUser();
        $this->taskList = $taskList;
    }

    protected function executeQuery(QueryBuilder $queryBuilder): TaskList
    {
        $result = $queryBuilder->andWhere(
            $queryBuilder->expr()->eq('t.user', $this->user->getId())
        )
            ->orderBy('t.title', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->taskList->setTasks($result);
    }

    abstract public function getTaskList(): TaskList;
}
