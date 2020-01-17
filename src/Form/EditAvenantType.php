<?php

namespace App\Form;

use App\Entity\Avenant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class EditAvenantType extends AbstractType
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
            ->add('Libelle',TextType::class,$this->getConfigue('Avenant N°',"Tapez Le Numero de L'Avenant",true))
            ->add('MontantAvenant',MoneyType::class,$this->getConfigue("Montant de L'Avenant :","Tapez le Montant de L'Avenant",true))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Avenant::class,
        ]);
    }
}
