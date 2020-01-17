<?php

namespace App\Form;

use App\Entity\Regelement;
use App\Entity\Fournisseurs;
use App\Entity\ModeRegelement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegelementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('montantRegelement')
            ->add('Fournissuer', EntityType::class, [
                'class' => Fournisseurs::class,
                'choice_label' => 'NomComplet',
            ])
            ->add('date')
            ->add('modeRegelement', EntityType::class, [
                'class' => ModeRegelement::class,
                'choice_label' => 'libelle',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Regelement::class,
        ]);
    }
}
