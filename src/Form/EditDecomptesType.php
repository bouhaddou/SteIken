<?php

namespace App\Form;

use App\Entity\Decomptes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class EditDecomptesType extends AbstractType
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
        ->add('Libelle',TextType::class,$this->getConfigue('Décompte N°','Tapez Le Numero de Décompte',true))
        ->add('MontantDecompte',MoneyType::class,$this->getConfigue('Montant de Décompte :','Tapez le Montant de Décompte',true))
        ->add('date',DateType::class,$this->getConfigue('Date de Création :','Tapez la Prorata  de Marché',false))
       
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Decomptes::class,
        ]);
    }
}
