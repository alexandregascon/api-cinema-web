<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiUserConnexion
{
    private HttpClientInterface $client;

    /**
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    public function connexionUser(string $email, string $password): array
    {
        try{
            $reponseAPI = $this->client->request(
                'POST',
                'http://172.26.144.1:8000/api/login_check',[
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type'=> 'application/json'
                    ],
                    'body'=>json_encode([
                        "username" => $email,
                        "password" => $password
                    ])
                ]
            );
            return $reponseAPI->toArray();
        }catch(\Exception $e){
//            dd($reponseAPI->getContent(false));
            $erreur = json_decode($reponseAPI->getContent(false));
            return ["code"=>$erreur->status, "message"=>$erreur->title];
        }
    }
}