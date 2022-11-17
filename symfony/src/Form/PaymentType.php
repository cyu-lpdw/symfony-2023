<?php

namespace App\Form;

use App\Entity\Payment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', MoneyType::class, [
                'divisor' => 100
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    "Accepté" => "ACCEPTED",
                    "Refusé" => "REFUSED"
                ],
            ])
            ->add('paymentMethod', ChoiceType::class, [
                'choices' => [
                    'Éspèces' => "ESP",
                    'Carte bleue' => "CB",
                    "Ticket restaurant" => "REST_TICKET"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Payment::class,
        ]);
    }
}
