<?php

namespace App\Controller;

use App\Form\LoginType;
use App\Form\UserType;
use App\Model\LoginModel;
use App\Model\UserModel;
use App\Service\ApiUserConnexion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConnexionUserController extends AbstractController
{
    private ApiUserConnexion $apiUserConnexion;

    /**
     * @param ApiUserConnexion $apiUserConnexiob
     */
    public function __construct(ApiUserConnexion $apiUserConnexion)
    {
        $this->apiUserConnexion = $apiUserConnexion;
    }
    #[\Symfony\Component\Routing\Annotation\Route('/connexion/user', name: 'app_user_login')]
    public function login(RequestStack $requestStack): Response
    {
        $login = new UserModel();
        // Créer le formulaire
        $form = $this->createForm(UserType::class, $login);

        // Traiter la soumission du formulaire
        $form->handleRequest($requestStack->getCurrentRequest());
        if($form->isSubmitted() and $form->isValid()){
            $login = $form->getData();
            $reponse = $this->apiUserConnexion->connexionUser($login->getEmail(),$login->getMdp());
            if(!empty($reponse["token"])) {
                // Ajouter un message flash
                $session = $requestStack->getSession();
                $session->set("token", $reponse);
                $this->addFlash("success", "Vous êtes connecté");
                return $this->redirectToRoute("app_accueil"); // Redirection vers la route désirée
            }else{
                $form->addError(new FormError($reponse["message"]));
            }
        }
        // Appel à la vue afin d'afficher les données
        return $this->render("connexion_user/index.html.twig", [
            'form' => $form
        ]);
    }
}
