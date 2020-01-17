<?php

namespace App\Form;

use App\Entity\Achats;
use App\Entity\Fournisseurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AchatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('Date')
            ->add('Montant')
            ->add('valide')
            ->add('Fournisseur', EntityType::class, [
                'class' => Fournisseurs::class,
                'choice_label' => 'NomComplet',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Achats::class,
        ]);
    }
}
