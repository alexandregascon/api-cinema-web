<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiFilmDetail
{
    private HttpClientInterface $client;

    /**
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    public function recupFilmsDetail(int $id): array
    {
        $reponseAPI = $this->client->request(
            'GET',
            'http://172.26.144.1:8000/api/film/'.$id
        );
        return $reponseAPI->toArray();
    }
}