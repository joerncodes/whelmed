<?php

namespace App\Domain\Task\Tokenizer;

use App\Domain\Task\Tokenizer\TokenizerInterface;
use App\Entity\Task;
use App\Transfer\TaskTokenizerPart;
use Webmozart\Assert\Assert;

class Tokenizer
{
    /**
     * @var iterable
     */
    private $tokenizers;

    public function __construct(iterable $tokenizers)
    {
        Assert::allIsInstanceOf($tokenizers, TokenizerInterface::class);
        $this->tokenizers = $tokenizers;
    }

    public function tokenize(TaskTokenizerPart $tokenizerPart): TaskTokenizerPart
    {
        foreach($this->tokenizers as $tokenizer) {
            /** @var TokenizerInterface $tokenizer */
            $tokenizerPart = $tokenizer->tokenize($tokenizerPart);
        }

        return $tokenizerPart;
    }
}
