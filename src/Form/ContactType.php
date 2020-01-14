<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactType extends AbstractType
{
    private function getConfig($label,$place )
    {
        return  [
            'label' => $label,
            'attr' => [
                'placeholder' => $place
            ]
        ];
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name',TextType::class,$this->getConfig('Nom Complet :','Tapez  votre Nom Complet !! '))
            ->add('Email',TextType::class,$this->getConfig('Email :','Tapez  Email !!'))
            ->add('Subject',TextType::class,$this->getConfig('Objet :','Tapez super Objet !!'))
            ->add('Phone',TextType::class,$this->getConfig('Téléphone :','Tapez  votre Téléphone'))
            ->add('Message',TextareaType::class,$this->getConfig('Message :','Tapez votre  Message '))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
