<?php

namespace App\Repository;

use App\Domain\Task\TaskList;
use App\Entity\Task;
use App\Entity\User;
use App\Repository\Traits\HasUuid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NoResultException;
use Ramsey\Uuid\Uuid;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    use HasUuid;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function flush():void
    {
        $this->getEntityManager()->flush();
    }

    public function remove(Task $task): void
    {
        $this->getEntityManager()->remove($task);
    }

    public function save(Task $task): void
    {
        $this->getEntityManager()->persist(($task));
    }

    public function saveAndFlush(Task $task): void
    {
        $this->save($task);
        $this->getEntityManager()->flush();
    }

    public function findAllTasks(User $user): TaskList
    {
        return new TaskList($this->findAllByUser($user));
    }

    public function findAllByUser(User $user)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.user= :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Task[] Returns an array of Task objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Task
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
