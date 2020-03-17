<?php

namespace App\Api\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NotFound extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(['message' => 'The requested ressource could not be found.'], Response::HTTP_NOT_FOUND, []);
    }
}
