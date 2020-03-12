<?php

namespace App\Action\Task\Modify;

use App\Domain\Query\Task\ByUuid;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Webmozart\Assert\Assert;

class Complete extends Base
{
    /**
     * @Route("/task/complete/{uuid}", name="task.complete")
     */
    public function __invoke(string $uuid): RedirectResponse
    {
        $task = $this->getTaskOrFail($uuid)
                ->setCompletedDate(new \DateTime())
                ->setFlagged(false);

        $this->repository->saveAndFlush($task);

        return $this->redirectBack();
    }
}
