<?php

namespace App\Form;

use App\Model\UserModel;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                "label" => "Email de l'utilisateur",
                "attr" => [
                    "placeholder" => "Entrez un email valide"
                ],
                "required" => true,
            ])
            ->add('mdp',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                "label" => "Mot de passe",
                "attr" => [
                    "placeholder" => "Entrez un mot de passe valide"
                ],
                "required" => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "data_class" => UserModel::class
        ]);
    }
}
