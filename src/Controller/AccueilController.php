<?php

namespace App\Controller;

use App\Service\ApiFilmAffiches;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{

    private ApiFilmAffiches $apiFilmAffiches;

    /**
     * @param ApiFilmAffiches $apiFilmAffiches
     */
    public function __construct(ApiFilmAffiches $apiFilmAffiches)
    {
        $this->apiFilmAffiches = $apiFilmAffiches;
    }

    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        $films = $this->apiFilmAffiches->recupFilmsAffiche();
        return $this->render('accueil/index.html.twig',["films"=>$films]);
    }
}
