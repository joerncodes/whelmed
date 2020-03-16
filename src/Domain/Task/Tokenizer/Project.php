<?php

namespace App\Domain\Task\Tokenizer;

use App\Entity\Project as ProjectEntity;
use App\Domain\Query\Project\ByTitle;
use App\Repository\ProjectRepository;
use App\Transfer\TaskTokenizerPart;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Security\Core\Security;

class Project implements TokenizerInterface
{
    const REGEX = '%#(?P<projectTitle>[a-zA-Z\s]+)%i';
    /**
     * @var ByTitle
     */
    private $byTitleQuery;
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * @var \Symfony\Component\Security\Core\User\UserInterface|null
     */
    private $user;

    public function __construct(ByTitle $byTitleQuery, ProjectRepository $projectRepository, Security $security)
    {
        $this->byTitleQuery = $byTitleQuery;
        $this->projectRepository = $projectRepository;
        $this->user = $security->getUser();
    }

    public function tokenize(TaskTokenizerPart $tokenizerPart): TaskTokenizerPart
    {
        $matches = [];
        if(preg_match(self::REGEX, $tokenizerPart->getTaskTitle(), $matches)) {
            $projectTitle = $matches['projectTitle'];

            try {
                $project = $this->byTitleQuery->get($projectTitle);
            }
            catch(NoResultException $e) {
                $project = (new ProjectEntity())
                    ->setTitle($projectTitle)
                    ->setUser($this->user);
                $this->projectRepository->saveAndFlush($project);
            }

            $tokenizerPart->setTaskTitle(
                preg_replace(self::REGEX, '', $tokenizerPart->getTaskTitle())
            );
            $tokenizerPart->getTask()->setProject($project);
        }
        return $tokenizerPart;
    }
}
