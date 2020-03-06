<?php

namespace App\Form;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('date_doc', DateType::class, [
            'label' => 'Date de creation du document'
            ])
        ->add('titre', TextType::class, [
            'label' => 'Titre du document'
            ])
        ->add('ref', TextType::class, [
            'label' => 'Réference du document'
            ])
        ->add('brochureFilename', FileType::class, [
                'label' => 'choisissez un fichier'
                ])
        ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
