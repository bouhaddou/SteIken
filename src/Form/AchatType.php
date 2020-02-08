<?php

namespace App\Form;

use App\Entity\AchatReg;
use App\Entity\Fournisseurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AchatType extends AbstractType
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
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseurs::class,
                'choice_label' => 'NomComplet',
            ])
            ->add('date',DateType::class,$this->getConfigue('Date de Création :','Tapez la Prorata  de Marché',false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AchatReg::class,
        ]);
    }
}
