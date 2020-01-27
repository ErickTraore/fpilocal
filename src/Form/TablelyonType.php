<?php

namespace App\Form;

use App\Entity\Tablelyon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TablelyonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('username')
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Secrétaire Général' => 'Secrétaire Général',
                    'SGA chargé de l\'administration' => 'SGA chargé de l\'administration',
                    'SGA chargé de la mobilisation' => 'SGA chargé de la mobilisation',
                    'SGA chargé de l\'organisation' => 'SGA chargé de l\'organisation',
                    'SGA chargé des affaires juridiques'   => 'SGA chargé des affaires juridiques',
                    'SGA chargé des affaires extérieures' => 'SGA chargé des affaires extérieures',
                    'SGA chargé des affaires culturelles' => 'SGA chargé des affaires culturelles',
                    'SGA chargé des affaires socialles' => 'SGA chargé des affaires socialles',
                    'SGA chargé des relations avec les partis politiques' => 'SGA chargé des relations avec les partis politiques',
                    'SGA chargé des relations avec les associations' => 'SGA chargé des relations avec les associations',
                    'SGA chargé des relations avec les opérateurs économiques' => 'SGA chargé des relations avec les opérateurs économiques',
                    'SGA chargé du secteur nord' =>'SGA chargé du secteur nord',
                    'SGA chargé du secteur sud' => 'SGA chargé du secteur sud',
                    'SGA chargé du secteur est' =>   'SGA chargé du secteur est',
                    'SGA chargé du secteur ouest' => 'SGA chargé du secteur ouest',
                    '1er SGA chargé de la reconciliation' => '1er SGA chargé de la reconciliation',
                    '2em SGA chargé de la libération du camarade K.L.G'=>'2em SGA chargé de la libération du camarade K.L.G',
                    '3em SGA chargé de la propagande du parti et de la formation'=>'3em SGA chargé de la propagande du parti et de la formation',
                    'conseiller spécial chargé des affaires financières'=>'conseiller spécial chargé des affaires financières',
                    'conseiller spécial chargé de la promotion des militants'=>'conseiller spécial chargé de la promotion des militants',
                    'conseiller spécial chargé des projets associatifs et culturels'=>'conseiller spécial chargé des projets associatifs et culturel',
                    'conseiller spécial chargé des nouvelles technologies' => 'conseiller spécial chargé des nouvelles technologies',
                ],
                'preferred_choices' => ['muppets', 'ROLE_SYMPATHISANT'],
            ])
            ->add('titre')
            
            ->add('Annuler', SubmitType::class, ['label' => 'Annuler'])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tablelyon::class,
        ]);
    }
}
