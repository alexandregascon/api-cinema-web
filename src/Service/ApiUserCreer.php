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
    public function creerUser(string $email, string $password): array
    {
        try{
            $reponseAPI = $this->client->request(
                'POST',
                'http://172.20.192.1:8000/api/user',[
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type'=> 'application/json'
                    ],
                    'body'=>json_encode([
                        "email" => $email,
                        "password" => $password
                    ])
                ]
            );
            return $reponseAPI->toArray();
        }catch(\Exception $e){
            $erreur = json_decode($reponseAPI->getContent(false));
            return ["code"=>$erreur->code, "message"=>$erreur->message];
        }
    }
}