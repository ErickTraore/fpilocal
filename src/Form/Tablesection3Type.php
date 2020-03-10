<?php

namespace App\Form;

use App\Entity\Tablesection3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Tablesection3Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstname', TextType::class, [
            'label' => 'Nom'
            ])
        ->add('lastname', TextType::class, [
            'label' => 'Prénom'
            ])
        ->add('username', TextType::class, [
            'label' => 'n° téléphone'
            ])
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Aucun' => 'Aucun',
                    'Secrétaire Général' => 'Secrétaire Général',
                    '1er Secrétaire Général Adjoint' => '1er Secrétaire Général Adjoint',
                    'SGA chargé de l\'administration' => 'SGA chargé de l\'administration',
                    'SGA chargé de la tresorerie' => 'SGA chargé de la tresorerie',
                    'SGA chargé du contrôle financier et administratif' => 'SGA chargé du contrôle financier et administratif' ,
                    'SGA chargé de la communication' => 'SGA chargé de la communication',
                    'SGA chargé de la mobilisation' => 'SGA chargé de la mobilisation',
                    'SGA chargé de l\'organisation' => 'SGA chargé de l\'organisation',
                    '2 emme SGA chargé de l\'organisation' => '2 emme SGA chargé de l\'organisation',
                    'SGA chargé des affaires juridiques'   => 'SGA chargé des affaires juridiques',
                    'SGA chargé des affaires extérieures' => 'SGA chargé des affaires extérieures',
                    'SGA chargé des affaires culturelles' => 'SGA chargé des affaires culturelles',
                    'SGA chargé des affaires socialles' => 'SGA chargé des affaires socialles',
                    'SGA chargé des relations avec les partis politiques' => 'SGA chargé des relations avec les partis politiques',
                    'SGA chargé des relations avec les associations' => 'SGA chargé des relations avec les associations',
                    'SGA chargé des relations avec les opérateurs économiques' => 'SGA chargé des relations avec les opérateurs économiques',
                    'SGA chargé de la sécurité' => 'SGA chargé de la sécurité',
                    'SGA chargé du secteur nord' =>'SGA chargé du secteur nord',
                    'SGA chargé du secteur sud' => 'SGA chargé du secteur sud',
                    'SGA chargé du secteur est' =>   'SGA chargé du secteur est',
                    'SGA chargé du secteur ouest' => 'SGA chargé du secteur ouest',
                    '4em SGA chargé de la reconciliation' => '4em SGA chargé de la reconciliation',
                    '2em SGA chargé de la libération du camarade K.L.G'=>'2em SGA chargé de la libération du camarade K.L.G',
                    '3em SGA chargé de la propagande du parti et de la formation'=>'3em SGA chargé de la propagande du parti et de la formation',
                    'Hotesse chargé de la cellule accueille' =>  'Hotesse chargé de la cellule accueille',
                    'conseiller spécial chargé des affaires financières'=>'conseiller spécial chargé des affaires financières',
                    'conseiller spécial chargé de l\'organisation et du patrimoine' => 'conseiller spécial chargé de l\'organisation et du patrimoine',
                    'conseiller spécial chargé des projets associatifs et culturels'=>'conseiller spécial chargé des projets associatifs et culturels',
                    'conseiller spécial chargé des nouvelles technologies' => 'conseiller spécial chargé des nouvelles technologies',
                    'Membre d\'honneur' => 'Membre d\'honneur',
                    'Membre chargé de l\'animation' => 'Membre chargé de l\'animation',
                ],
                'preferred_choices' => ['muppets', 'ROLE_SYMPATHISANT'],
            ])
            ->add('titre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tablesection3::class,
        ]);
    }
}
