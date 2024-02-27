<?php

namespace App\Form;

use App\Entity\Maison;
use App\Enum\VilleEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class MaisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => ['placeholder' => 'Entrez votre nom'],
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'Entrez votre email'],
                'constraints' => [
                    new Email(['message' => 'L\'adresse email "{{ value }}" n\'est pas valide.'])
                ]
            ])
            ->add('nbChambres')
            ->add('capacite')
            ->add('localisation')
            ->add('ville',ChoiceType::class, [
                'choices'=>['Nabeul'=>'nabeul','Tunis'=>'tunis','Ariana'=>'ariana'],
                'placeholder' => 'Veuillez entrer la ville de votre maison d\'hote',])
                ->add('disponibilite',ChoiceType::class, [
                    'choices'=>['Disponible'=>'Disponible','Complet'=>'Complet'],
                    'placeholder' => 'Veuillez entrer la disponibilité de votre hotel',])
            ->add('description')
            ->add('image',FileType::class,[
                'mapped'=>false,
                'label' => false,])
            ->add('prix')
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Maison::class,
        ]);
    }
}
