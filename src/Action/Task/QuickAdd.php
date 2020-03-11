<?php

namespace App\Action\Task;

use App\Entity\Task;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class QuickAdd extends Base
{
    const FORM_INPUT_NAME = 'whelmed-task-quick-add';

    /**
     * @Route("/task/quick-add", name="task.quick-add", methods={"POST"})
     */
    public function __invoke(Request $request, UrlGeneratorInterface $router): Response
    {
        if (!$request->request->has(self::FORM_INPUT_NAME)) {
            throw new NotFoundHttpException();
        }

        $task = (new Task())
            ->setTitle($request->request->get(self::FORM_INPUT_NAME));

        $this->repository->saveAndFlush($task);

        return new RedirectResponse(
            $router->generate('task.view', ['uuid' => $task->getUuid()])
        );
    }
}
