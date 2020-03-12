<?php

namespace App\Action\Task\Modify;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Unflag extends Base
{
    /**
     * @Route("/task/unflag/{uuid}", name="task.unflag")
     */
    public function __invoke(Request $request, UrlGeneratorInterface $router, string $uuid)
    {
        $task = $this->getTaskOrFail($uuid)
            ->setFlagged(false);

        $this->repository->saveAndFlush($task);

        return $this->redirectBack();
    }
}
