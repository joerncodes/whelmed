<?php

namespace App\Domain\Task\Tokenizer;

use App\Domain\Query\Project\ByTitleOrCreate;
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
     * @var ByTitleOrCreate
     */
    private $byTitleOrCreate;

    public function __construct(ByTitleOrCreate $byTitleOrCreate)
    {
        $this->byTitleOrCreate = $byTitleOrCreate;
    }

    public function tokenize(TaskTokenizerPart $tokenizerPart): TaskTokenizerPart
    {
        $matches = [];
        if (preg_match(self::REGEX, $tokenizerPart->getTaskTitle(), $matches)) {
            $projectTitle = $matches['projectTitle'];

            $project = $this->byTitleOrCreate->get($projectTitle);

            $tokenizerPart->setTaskTitle(
                preg_replace(self::REGEX, '', $tokenizerPart->getTaskTitle())
            );
            $tokenizerPart->getTask()->setProject($project);
        }
        return $tokenizerPart;
    }
}
