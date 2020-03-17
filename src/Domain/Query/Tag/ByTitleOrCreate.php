<?php

namespace App\Domain\Query\Tag;

use App\Entity\Tag;
use App\Entity\User;
use App\Repository\TagRepository;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Security\Core\Security;
use Webmozart\Assert\Assert;

class ByTitleOrCreate
{
    /**
     * @var ByTitle
     */
    private $byTitle;
    /**
     * @var Security
     */
    private $security;
    /**
     * @var \Symfony\Component\Security\Core\User\UserInterface|null
     */
    private $user;
    /**
     * @var TagRepository
     */
    private $repository;

    public function __construct(ByTitle $byTitle, Security $security, TagRepository $repository)
    {
        $this->byTitle = $byTitle;
        $this->user = $security->getUser();
        $this->security = $security;
        $this->repository = $repository;

        Assert::isInstanceOf($this->user, User::class);
    }

    public function get(string $title): Tag
    {
        try
        {
            return $this->byTitle->get($title);
        }
        catch(NoResultException $e) {
            $tag = (new Tag())
                ->setTitle($title)
                ->setUser($this->user);

            $this->repository->saveAndFlush($tag);

            return $tag;
        }
    }
}
