<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiFilmAffiches
{
    private HttpClientInterface $client;

    /**
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    public function recupFilmsAffiche(): array
    {
        $reponseAPI = $this->client->request(
            'GET',
            'http://172.20.192.1:8000/api/film'
        );
        return $reponseAPI->toArray();
    }
}