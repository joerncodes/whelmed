<?php

namespace App\Action\Task;

use App\Domain\Query\Project\All as AllQuery;
use App\Domain\Query\Project\ByUuid;
use App\Entity\Task;
use App\Form\Type\TaskType;
use App\Repository\TaskRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;

class Add
{
    private $formFactory;
    /**
     * @var TaskRepository
     */
    private $repository;
    /**
     * @var \Symfony\Component\Security\Core\User\UserInterface|null
     */
    private $user;
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var UrlGeneratorInterface
     */
    private $router;
    /**
     * @var AllQuery
     */
    private $allQuery;
    /**
     * @var ByUuid
     */
    private $byUuid;

    public function __construct(
        $formFactory,
        TaskRepository $repository,
        Security $security,
        Environment $twig,
        UrlGeneratorInterface $router,
        AllQuery $allQuery,
        ByUuid $byUuid
    ) {
        $this->formFactory = $formFactory;
        $this->repository = $repository;
        $this->user = $security->getUser();
        $this->twig = $twig;
        $this->router = $router;
        $this->allQuery = $allQuery;
        $this->byUuid = $byUuid;
    }

    /**
     * @Route("/task/add", name="task.add")
     */
    public function __invoke(Request $request): Response
    {
        if ($request->getMethod() === Request::METHOD_POST) {
            $data = $request->request->all();
            $task = (new Task())
                ->setTitle($data['task']['title'])
                ->setUser($this->user);

            if (!empty($data['task']['project-uuid'])) {
                $task->setProject($this->byUuid->get(Uuid::fromString($data['task']['project-uuid'])));
            }
            if (!empty($data['task']['dueDate'])) {
                $dateTime = (new \DateTimeImmutable())->setTimestamp(strtotime($data['task']['dueDate']));
                $task->setDueDate($dateTime);
            }
            $task->setFlagged(
                !empty($data['task']['flagged']) && $data['task']['flagged'] === 'true'
            );

            $this->repository->saveAndFlush($task);

            return new RedirectResponse(
                $this->router->generate('task.view', ['uuid' => $task->getUuid()])
            );
        }

        $content = $this->twig->render(
            'organism/task/form.html.twig',
            ['projects' => $this->allQuery->getProjectList()]
        );

        return new Response($content);
    }
}
