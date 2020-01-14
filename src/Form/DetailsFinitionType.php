<?php

namespace App\Form;

use App\Entity\FinitionDetails;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class DetailsFinitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('designation')
            ->add('image', FileType::class,array(
            'label' => 'Url de votre Photos',
            'data_class' => null
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FinitionDetails::class,
        ]);
    }
}
