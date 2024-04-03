<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiUserCreer
{
    private HttpClientInterface $client;

    /**
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    public function creerUser(string $email, string $mdp): array
    {
        $reponseAPI = $this->client->request(
            'POST',
            'http://172.16.208.2:8000/api/user',[
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type'=> 'application/json'
                ],
                'body'=>json_encode([
                    "email" => $email,
                    "mdp" => $mdp
                ])
            ]
        );
        return $reponseAPI->toArray();
    }
}