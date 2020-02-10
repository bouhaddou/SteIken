<?php

namespace App\Form;

use App\Entity\ClientsPar;
use App\Entity\ClientsVentes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class VenteType extends AbstractType
{
    public function getConfigue($label,$placeholder,$valuer)
    {
        return  [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ],
            'required'=> $valuer
        ];
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('designation')
        ->add('libelle')
        ->add('debit')
        ->add('observation')
        ->add('date',DateType::class,$this->getConfigue('Date de Création :','Tapez la Prorata  de Marché',false))
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ClientsVentes::class,
        ]);
    }
}
