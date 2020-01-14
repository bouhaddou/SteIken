<?php

namespace App\Form;

use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProduitType extends AbstractType
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
            ->add('slug',TextType::class,$this->getConfig('Désignation :','Tapez  la  Désignation de prduit'))
            ->add('description',TextareaType::class,$this->getConfig('Description (mesure) :','Tapez  la description de produit'))
            ->add('image', FileType::class,array(
                'label' => 'Url de votre Photos',
            ))
            
            ->add('date',TextareaType::class,$this->getConfig('Date publication :','Tapez  la Date de publication '))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
