<?php

namespace App\Form;

use App\Entity\Hotel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class HotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('email')
            ->add('telephone')
            ->add('nbEtoiles',ChoiceType::class, [
                'choices'=>['3 Etoiles'=>'3 Etoiles','3 Etoiles Plus'=>'3 Etoiles Plus','4 Etoiles'=>'4 Etoiles','4 Etoiles Plus'=>'4 Etoiles Plus','5 Etoiles'=>'5 Etoiles'],
                'placeholder' => 'Veuillez entrer le nombre d\'etoiles de votre hotel',])
            ->add('localisation')
            ->add('ville',ChoiceType::class, [
                'choices'=>['Nabeul'=>'nabeul','Tunis'=>'tunis','Ariana'=>'ariana'],
                'placeholder' => 'Veuillez entrer la ville de votre hotel',])
            ->add('disponibilite',ChoiceType::class, [
                'choices'=>['Disponible'=>'Disponible','Complet'=>'Complet'],
                'placeholder' => 'Veuillez entrer la disponibilité de votre hotel',])
            ->add('description')
            ->add('prix')
            ->add('image',FileType::class,[
                'mapped'=>false,
                'label' => false,])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class,
        ]);
    }
}
