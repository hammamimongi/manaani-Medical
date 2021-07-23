<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
                'attr'=>['placeholder' => 'Entrer votre nom']
            ])
            ->add('prenom',TextType::class,[
                'attr'=>['placeholder' => 'Entrer votre prenom']
            ])
            ->add('mail',EmailType::class,[
                'attr'=>['placeholder' => 'Entrer votre Adresse email']
            ])
            ->add('password',PasswordType::class,[
                'attr'=>['placeholder' => 'Entrer votre mot de passe']
            ])
            ->add('confirmPassword',PasswordType::class,[
                'attr'=>['placeholder' => 'Confirmer votre mot de passe']
            ])
            ->add('numTel',NumberType::class,[
                'attr'=>['placeholder' => '+216 xx xxx xxx']
            ])
            ->add('pdp',FileType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
