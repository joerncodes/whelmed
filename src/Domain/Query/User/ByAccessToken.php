<?php

namespace App\Domain\Query\User;

use App\Entity\User;
use App\Repository\AccessTokenRepository;
use App\Repository\UserRepository;
use App\Transfer\Token;

class ByAccessToken
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var AccessTokenRepository
     */
    private $tokenRepository;

    public function __construct(UserRepository $userRepository, AccessTokenRepository $tokenRepository)
    {
        $this->userRepository = $userRepository;
        $this->tokenRepository = $tokenRepository;
    }

    public function get(Token $token): User
    {
        $accessToken = $this->tokenRepository->findOneBy(['token' => $token->getToken()]);
        return $accessToken->getUser();
    }
}
