<?php

namespace App\Form;

use App\Entity\Mode;
use App\Entity\AchatReg;
use App\Entity\Fournisseurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegelementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('libelle')
            ->add('observation')
            ->add('credit')
            ->add('banque')
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseurs::class,
                'choice_label' => 'NomComplet',
            ])
            ->add('Mode',EntityType::class, [
                'class' => Mode::class,
                'choice_label' => 'modeReg',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AchatReg::class,
        ]);
    }
}
