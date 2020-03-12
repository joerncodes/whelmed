<?php

namespace App\Action\Task;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;

class QuickAdd extends Base
{
    const FORM_INPUT_NAME = 'whelmed-task-quick-add';

    /**
     * @Route("/task/quick-add", name="task.quick-add", methods={"POST"})
     */
    public function __invoke(Request $request, TaskRepository $repository, UrlGeneratorInterface $router, Security $security): Response
    {
        if (!$request->request->has(self::FORM_INPUT_NAME)) {
            throw new NotFoundHttpException();
        }

        $task = (new Task())
            ->setTitle($request->request->get(self::FORM_INPUT_NAME))
            ->setUser($security->getUser())
        ;

        $repository->saveAndFlush($task);

        return new RedirectResponse(
            $router->generate('task.view', ['uuid' => $task->getUuid()])
        );
    }
}
