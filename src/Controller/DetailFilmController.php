<?php

namespace App\Controller;

use App\Service\ApiFilmDetail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DetailFilmController extends AbstractController
{
    private ApiFilmDetail $apiFilmDetail;

    /**
     * @param $this->apiFilmDetail $apiFilmAffiches
     */
    public function __construct(apiFilmDetail $apiFilmDetail)
    {
        $this->apiFilmDetail = $apiFilmDetail;
    }

    #[Route('/film/{id}', name: 'app_detail_film')]
    public function index(int $id): Response
    {
        $position = 0;
        $film = $this->apiFilmDetail->recupFilmsDetail($id);
        foreach ($film[0]["seances"] as $seance){
            $film[0]["seances"][$position]["dateProj"] = substr($seance["dateProj"],0,10);
            $position += 1;
        }
        return $this->render('detail_film/index.html.twig', [
            'controller_name' => 'DetailFilmController',
            "film"=>$film,
        ]);
    }
}
