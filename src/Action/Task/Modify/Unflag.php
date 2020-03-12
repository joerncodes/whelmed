<?php

namespace App\Action\Task\Modify;

use App\Action\Task\Base;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Webmozart\Assert\Assert;

class Unflag extends Base
{
    /**
     * @Route("/task/unflag/{uuid}", name="task.unflag")
     */
    public function __invoke(Request $request, UrlGeneratorInterface $router, string $uuid)
    {
        $task = $this->getTaskOrFail($uuid);
        $task->setFlagged(false);

        $this->repository->saveAndFlush($task);

        $path = $request->headers->get('referer');
        if ($path === null) {
            $router->generate('task.all');
        }
        Assert::notNull($path);

        return new RedirectResponse($path);
    }
}
