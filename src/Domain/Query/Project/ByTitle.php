<?php

namespace App\Domain\Query\Project;

use App\Entity\Project;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Security\Core\Security;
use Webmozart\Assert\Assert;

class ByTitle
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

    public function get(string $title): Project
    {
        $result = $this->queryBuilder
            ->select('p')
            ->from(Project::class, 'p')
            ->andWhere(
                $this->queryBuilder->expr()->like('p.title', ':title'),
                $this->queryBuilder->expr()->eq('p.user', ':user')
            )
            ->setParameter('title', '%' . $title . '%')
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
