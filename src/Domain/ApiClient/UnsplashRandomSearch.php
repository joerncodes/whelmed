<?php

namespace App\Domain\ApiClient;

use Symfony\Component\HttpClient\HttpClient;

class UnsplashRandomSearch
{
    const SEARCH_KEYWORD = 'nature';
    const SEARCH_ORIENTATION = 'landscape';
    const API_URL_SEARCH = 'https://api.unsplash.com/search/photos';

    /**
     * @var string
     */
    private $accessKey;
    /**
     * @var string
     */
    private $secretKey;

    public function __construct(string $accessKey, string $secretKey)
    {
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
    }

    public function getRandomPhoto(): object
    {
        $response = HttpClient::create()->request('GET', self::API_URL_SEARCH, [
              'headers' => [
                  'Authorization' => 'Client-ID ' . $this->accessKey,
              ],
            'query' => [
                'query' => self::SEARCH_KEYWORD,
                'orientation' => self::SEARCH_ORIENTATION,
            ],
        ]);

        $result = json_decode($response->getContent());

        return $result->results[array_rand($result->results)];
    }

}
