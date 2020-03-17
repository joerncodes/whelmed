<?php

namespace App\Transfer;

use Webmozart\Assert\Assert;

class Token
{
    /**
     * @var string
     */
    private $token;

    public function __construct(string $token)
    {
        Assert::string($token);
        Assert::length($token, 32);
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Token
     */
    public function setToken(string $token): Token
    {
        $this->token = $token;
        return $this;
    }
}
