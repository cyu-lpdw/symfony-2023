<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price', MoneyType::class, [
                'currency' => 'EUR',
                'divisor' => 100
            ])
            ->add('description')
            ->add('uom', ChoiceType::class, [
                'choices'  => [
                    'Unité' => 'EACH',
                    'Kilogramme' => 'KG',
                    'Litre' => 'L',
                    'Mètre' => 'M',
                    'Heure' => 'H',
                ]])
            ->add('tax', ChoiceType::class, [
                'choices'  => [
                    'Taux normal' => 2000,
                    'Taux intermédiaire' => 1000,
                    'Taux réduit' => 550,
                ]])
            ->add('color', ColorType::class, [
                'data' => "#1E4294"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
