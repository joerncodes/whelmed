<?php

namespace App\Repository\Traits;

use Doctrine\ORM\NoResultException;
use Ramsey\Uuid\Uuid;

trait HasUuid
{
    public function findOneByUuidOrFail(Uuid $uuid)
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
