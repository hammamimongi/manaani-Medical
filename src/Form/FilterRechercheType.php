<?php


namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Smyfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('adresse',TextareaType::class)


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
/*
 {
        $builder

            ->add('quantite',ChoiceType::class,[
                'choices'=>[
                    'quantite L'=>'0',
                    '5 L'=>'5',
                    '6 L'=>'6',
                    '7 L'=>'7',
                    '8 L'=>'8',
                    '9 L'=>'9',
                    '10 L'=>'10',
                    '11 L'=>'11',
                    '12 L'=>'12',
                    '13 L'=>'13',
                    '14 L'=>'14',
                    '15 L'=>'15',
                    '16 L'=>'16',
                    '17 L'=>'17',
                    '18 L'=>'18',
                    '19 L'=>'19',
                    '20 L'=>'20',
                ]
            ])
            ->add('adresse',ChoiceType::class,[
            'choices'=>[
                'Gouvernerat'=>'Gouvernerat',
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
            ->add('prix',ChoiceType::class,[
                'choices'=>[
                    'Type'=>'-1',
                    'Payant'=>'0',
                    'Gratuit'=>'1',
                ]

 */