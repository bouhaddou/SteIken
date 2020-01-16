<?php

namespace App\Form;

use App\Entity\Clients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EditClientsType extends AbstractType
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
        ->add('NomComplete',TextType::class,$this->getConfigue('Raison Sociale','Tapez Le Nom de Client',true))
        ->add('objet',TextareaType::class,$this->getConfigue("objet de Marchés","Tapez l'objet   de Marché",True))
        ->add('telephone',TextType::class,$this->getConfigue('Téléphone','Tapez le Numero de Téléphone de client',false))
        ->add('Adresse',TextareaType::class,$this->getConfigue('Adresse','Tapez  L adresse De Client',true))
        ->add('MontantTravaux',MoneyType::class,$this->getConfigue('Montant des Travaux :','Tapez le Montant des Travaux',false))
        ->add('retenueGrantie',MoneyType::class,$this->getConfigue('Retenue de Garante','Tapez la Retenue de Garante',false))
        ->add('retenueFinition',MoneyType::class,$this->getConfigue('retenue Finition','Tapez La Retenue De Finition',false))
        ->add('RevesionPrix',MoneyType::class,$this->getConfigue('Révision des Prix','Tapez la Révision Des Prix',false))
        ->add('penalite',MoneyType::class,$this->getConfigue('Pénalité','Tapez la penalite  de Marché',false))
        ->add('Prorata',MoneyType::class,$this->getConfigue('Prorata','Tapez la Prorata  de Marché',false))
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Clients::class,
        ]);
    }
}
