<?php

namespace App\Domain\Query\Task;

use App\Domain\Task\TaskList;
use App\Entity\Task;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\Security;
use Webmozart\Assert\Assert;

class ByUuid
{
    /**
     * @var \Doctrine\ORM\QueryBuilder
     */
    private $queryBuilder;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->queryBuilder = $em->createQueryBuilder();
        $this->user = $security->getUser();
        Assert::isInstanceOf($this->user, User::class);
    }

    public function get(Uuid $uuid): Task
    {
        $result = $this->queryBuilder
            ->select('t')
            ->from(Task::class, 't')
            ->andWhere(
                $this->queryBuilder->expr()->eq('t.uuid', ':uuid'),
                $this->queryBuilder->expr()->eq('t.user', ':user')
            )
            ->setParameter('uuid', $uuid->toString())
            ->setParameter('user', $this->user)
            ->getQuery()
            ->getResult()
        ;

        if (count($result) !== 1) {
            throw new NoResultException();
        }

        return $result[0];
    }
}
