<?php

namespace App\Form;

use App\Entity\ReservationM;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints as Assert;

class ReservationMType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbAdultes')
            ->add('nbEnfants')
            ->add('datearrivee', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La date d\'arrivée est obligatoire']),
                ],
            ])
            ->add('datedepart', null, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La date de départ est obligatoire']),
                ],
            ])
            ->add('arrangement', ChoiceType::class, [
                'choices'  => [
                    'All Inclusive' => 'All Inclusive',
                    'Pension complete' => 'Pension complete',
                    'Demi Pension' => 'Demi Pension',
                    'Logement Petit Dejeuner' => 'Logement Petit Dejeuner',
                    'Logement Simple' => 'Logement Simple',
                ],
            ])
            ->add('repartition', ChoiceType::class, [
                'choices'  => [
                    'Single' => 'Single',
                    'Double' => 'Double',
                    'Triple' => 'Triple',
                    'Quadruple' => 'Quadruple',
                    'Appartement' => 'Appartement',
                    'Bungalow' => 'Bungalow',
                    'Suite Luxe' => 'Suite Luxe',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationM::class,
        ]);
    }
}
