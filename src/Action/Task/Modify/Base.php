<?php

namespace App\Action\Task\Modify;

use App\Domain\Query\Task\ByUuid;
use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\NoResultException;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Webmozart\Assert\Assert;

abstract class Base
{
    /**
     * @var ByUuid
     */
    protected $query;

    /**
     * @var TaskRepository
     */
    protected $repository;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    public function __construct(ByUuid $query, TaskRepository $repository, RequestStack $requestStack, UrlGeneratorInterface $router)
    {
        $this->query = $query;
        $this->repository = $repository;
        $this->request = $requestStack->getCurrentRequest();
        $this->router = $router;
    }

    protected function redirectBack(): RedirectResponse
    {
        $path = $this->request->headers->get('referer');
        if ($path === null) {
            $this->router->generate('task.all');
        }
        Assert::notNull($path);

        return new RedirectResponse($path);
    }

    protected function getTaskOrFail(string $uuid): Task
    {
        try {
            return $this->query->get(Uuid::fromString($uuid));
        } catch (InvalidUuidStringException | NoResultException $e) {
            throw new NotFoundHttpException();
        }
    }
}
