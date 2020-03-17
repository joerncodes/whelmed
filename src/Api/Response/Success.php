<?php

namespace App\Api\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class Success extends JsonResponse
{
    public function __construct($data = null, array $headers = [], bool $json = false)
    {
        $data = array_merge(['status' => 'success'], $data);
        parent::__construct($data, Response::HTTP_OK, $headers, $json);
    }
}
