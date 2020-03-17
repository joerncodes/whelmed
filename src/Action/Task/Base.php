<?php

namespace App\Action\Task;

use Twig\Environment;

abstract class Base
{
    /**
     * @var Environment
     */
    protected $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
}
