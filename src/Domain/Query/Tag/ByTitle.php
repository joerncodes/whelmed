<?php

namespace App\Domain\Query\Tag;

use App\Entity\Tag;
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

    public function get(string $title): Tag
    {
        $result = $this->queryBuilder
            ->select('t')
            ->from(Tag::class, 't')
            ->andWhere(
                $this->queryBuilder->expr()->like('t.title', ':title'),
                $this->queryBuilder->expr()->eq('t.user', ':user')
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
