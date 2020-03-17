<?php

namespace App\Domain\Task\Tokenizer;

use App\Transfer\TaskTokenizerPart;

interface TokenizerInterface
{
    public function tokenize(TaskTokenizerPart $tokenizerPart): TaskTokenizerPart;
}
