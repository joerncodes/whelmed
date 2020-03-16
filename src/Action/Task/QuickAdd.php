<?php

namespace App\Action\Task;

use App\Domain\Task\Tokenizer\Tokenizer;
use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Transfer\TaskTokenizerPart;
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
    public function __invoke(Request $request, TaskRepository $repository, UrlGeneratorInterface $router,
         Security $security, Tokenizer $tokenizer): Response
    {
        if (!$request->request->has(self::FORM_INPUT_NAME)) {
            throw new NotFoundHttpException();
        }

        $tokenizerPart = $tokenizer->tokenize(
            new TaskTokenizerPart($request->request->get(self::FORM_INPUT_NAME), new Task())
        );

        $task = $tokenizerPart->getTask()
            ->setTitle($tokenizerPart->getTaskTitle())
            ->setUser($security->getUser())
        ;

        $repository->saveAndFlush($task);

        return new RedirectResponse(
            $router->generate('task.view', ['uuid' => $task->getUuid()])
        );
    }
}
