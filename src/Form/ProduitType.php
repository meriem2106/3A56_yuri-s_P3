<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('origine')
            ->add('categ', ChoiceType::class, [
                'placeholder' => 'Select a category', // Optional placeholder text
                'choices' => [
                    'ART DE LA TABLE' => 'ART DE LA TABLE',
                    'VÊTEMENTS' => 'VÊTEMENTS',
                    'MAISON & DÉCORATION' => 'MAISON & DÉCORATION',
                    'BIJOUX & ACCESSOIRES' => 'BIJOUX & ACCESSOIRES',
                ],'label' => false,])
            ->add('matiere')
            ->add('image',FileType::class,[
                'mapped'=>false,
               
                'label' => false,])
            ->add('formation', EntityType::class, [
                    'class' => Formation::class,
                    'choice_label' => 'sujet', // Display the 'sujet' property of Formation entity
                    'placeholder' => 'Choose a formation', // Optional placeholder text
                    // Add more options as needed
                ]);
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
