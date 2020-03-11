<?php

namespace App\Action\Project;

use App\Entity\Project;
use App\Entity\Task;
use App\Repository\ProjectRepository;
use App\Repository\TaskRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Webmozart\Assert\Assert;

class AddTask
{
    const FORM_INPUT_PROJECT_UUID = 'whelmed-project-uuid';
    const FORM_INPUT_TASK_TITLE = 'whelmed-task';

    /**
     * @Route("/project/add/task", name="project.add-task", methods={"POST"})
     */
    public function __invoke(
        TaskRepository $taskRepository,
        ProjectRepository $projectRepository,
        Request $request,
        UrlGeneratorInterface $router
    ) {
        $uuid = Uuid::fromString($request->request->get(self::FORM_INPUT_PROJECT_UUID));
        $project = $projectRepository->findOneByUuidOrFail($uuid);

        Assert::isInstanceOf($project, Project::class);

        $task = (new Task())
            ->setTitle($request->request->get(self::FORM_INPUT_TASK_TITLE));
        $task->setProject($project);

        $taskRepository->saveAndFlush($task);

        return new RedirectResponse(
            $router->generate('project.view', ['uuid' => $uuid->toString()])
        );
    }
}
