<?php

namespace App\Action\Task\Modify;

use App\Domain\Query\Task\ByUuid;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Webmozart\Assert\Assert;

class Incomplete extends Base
{
    /**
     * @Route("/task/incomplete/{uuid}", name="task.incomplete")
     */
    public function __invoke(string $uuid): RedirectResponse
    {
        $task = $this->getTaskOrFail($uuid)
                ->setCompletedDate(null);

        $this->repository->saveAndFlush($task);

        return $this->redirectBack();
    }
}
