<?php

namespace App\Domain\Query\Project;

use App\Entity\Project;
use App\Entity\User;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Security\Core\Security;
use Webmozart\Assert\Assert;

class ByTitleOrCreate
{
    /**
     * @var \Doctrine\ORM\QueryBuilder
     */
    private $queryBuilder;
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var ByTitle
     */
    private $byTitle;
    /**
     * @var ProjectRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $em, Security $security, ByTitle $byTitle, ProjectRepository $repository)
    {
        $this->queryBuilder = $em->createQueryBuilder();
        $this->user = $security->getUser();
        $this->byTitle = $byTitle;
        $this->repository = $repository;

        Assert::isInstanceOf($this->user, User::class);
    }

    public function get(string $title): Project
    {
        try {
            return $this->byTitle->get($title);
        } catch (NoResultException $e) {
            $project = (new Project())
                ->setTitle($title)
                ->setUser($this->user);

            $this->repository->saveAndFlush($project);

            return $project;
        }
    }
}
