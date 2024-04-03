<?php

namespace App\Controller;

use App\Form\UserType;
use App\Model\UserModel;
use App\Service\ApiUserCreer;
use PhpParser\Builder\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreerUserController extends AbstractController
{

    private ApiUserCreer $apiUserCreer;

    public function __construct(ApiUserCreer $apiUserCreer)
    {
        $this->apiUserCreer = $apiUserCreer;
    }

    #[Route('/creer/user', name: 'app_creer_user')]
    public function index(RequestStack $requestStack): Response
    {

        $user = new UserModel();
        // Créer le formulaire
        $form = $this->createForm(UserType::class, $user);

        // Traiter la soumission du formulaire
        $form->handleRequest($requestStack->getCurrentRequest());
        if($form->isSubmitted() and $form->isValid()){
//            dd($form->isValid());
            // Traitement des données
            try{
//                dd($form->isSubmitted());
                $this->apiUserCreer->creerUser($form->getData()->getEmail(),$form->getData()->getMdp());
//                dd($form->isValid());
            }catch(\Exception $e){
                $erreur = 'erreur2';
//                 dd($form->getData()->getEmail());
                return $this->render('creer_user/index.html.twig', [
                    'form' => $form,
                    'erreur'=>$erreur
                ]);
            }
            // Ajouter un message flash
//            $this->addFlash("success","Le user a été enregistrée");
            return $this->redirectToRoute("app_accueil"); // Redirection vers la route désirée
        }
//        dd($form->isSubmitted());
        return $this->render('creer_user/index.html.twig', [
            'form' => $form,
            'erreur'=>'erreur'
        ]);
    }
}
