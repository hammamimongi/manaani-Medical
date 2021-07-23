<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class PostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image',FileType::class)
            ->add('quantite',IntegerType::class,[
                'attr'=>['placeholder' => 'Donner le modèles de bouteille 1l,2l etc... ']
            ])
            ->add('adresse',ChoiceType::class,[
                'choices'=>[
                    'Grand Tunis'=>'Grand Tunis',
                    'Béja'=>'Béja',
                    'Bizerte'=>'Bizerte',
                    'Gabés'=>'Gabés',
                    'Gafsa'=>'Gafsa',
                    'Jendouba'=>'Jendouba',
                    'Kairouan'=>'Kairouan',
                    'Kasserine'=>'Kasserine',
                    'Kébili'=>'Kébili',
                    'Le Kef'=>'Le Kef',
                    'Mahdia'=>'Mahdia',
                    'Médenin'=>'Médenin',
                    'Montastir'=>'Montastir',
                    'Nabeul'=>'Nabeul',
                    'Sfax'=>'Sfax',
                    'Sidi Bouzid'=>'Sidi Bouzid',
                    'Siliana'=>'Siliana',
                    'Sousse'=>'Sousse',
                    'Tataouine'=>'Tataouine',
                    'Tozuer'=>'Tozuer',
                    'Zaghouan'=>'Zaghouan',
                ]
            ])
            ->add('prix',IntegerType::class,[
                'attr'=>['placeholder' => 'Donner le prix de location par jours et Si gratuit ecrire 0']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
