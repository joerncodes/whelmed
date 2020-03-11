<?php

namespace App\Repository\Traits;

use App\Entity\Base;
use Doctrine\ORM\NoResultException;
use Ramsey\Uuid\UuidInterface;

trait HasUuid
{
    public function findOneByUuidOrFail(UuidInterface $uuid): Base
    {
        $result = $this->createQueryBuilder('t')
            ->andWhere('t.uuid = :uuid')
            ->setParameter('uuid', $uuid)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();

        if (count($result) !== 1) {
            throw new NoResultException();
        }

        return $result[0];
    }
}
