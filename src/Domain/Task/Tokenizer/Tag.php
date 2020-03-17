<?php

namespace App\Domain\Task\Tokenizer;

use App\Domain\Query\Tag\ByTitleOrCreate;
use App\Transfer\TaskTokenizerPart;

class Tag implements TokenizerInterface
{
    const REGEX = '%@(?P<tagTitle>[a-zA-Z\s]+)%i';

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
            $tagTitle = $matches['tagTitle'];

            $tag = $this->byTitleOrCreate->get($tagTitle);

            $tokenizerPart->setTaskTitle(
                preg_replace(self::REGEX, '', $tokenizerPart->getTaskTitle())
            );
            $tokenizerPart->getTask()->addTag($tag);
        }
        return $tokenizerPart;
    }
}
