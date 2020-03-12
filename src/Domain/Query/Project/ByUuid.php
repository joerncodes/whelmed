<?php

namespace App\Domain\Query\Project;

use App\Entity\Project;
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

    public function get(Uuid $uuid): Project
    {
        $result = $this->queryBuilder
            ->select('p')
            ->from(Project::class, 'p')
            ->andWhere(
                $this->queryBuilder->expr()->eq('p.uuid', ':uuid'),
                $this->queryBuilder->expr()->eq('p.user', ':user')
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
