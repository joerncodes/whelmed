<?php

namespace App\Repository;

use App\Entity\Project;
use App\Repository\Traits\HasUuid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    use HasUuid;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function flush():void
    {
        $this->getEntityManager()->flush();
    }

    public function remove(Project $Project): void
    {
        $this->getEntityManager()->remove($Project);
    }

    public function save(Project $Project): void
    {
        $this->getEntityManager()->persist(($Project));
    }

    public function saveAndFlush(Project $Project): void
    {
        $this->save($Project);
        $this->getEntityManager()->flush();
    }
}
