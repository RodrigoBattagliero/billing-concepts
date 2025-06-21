<?php

namespace App\Form;

use App\Const\ProductServiceType;
use App\Entity\Category;
use App\Entity\IvaApplication;
use App\Entity\ProductService;
use App\Entity\UnitMeasurement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class ProductServiceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Producto' => ProductServiceType::P,
                    'Servicio' => ProductServiceType::S,
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'category',
            ])
            ->add('code')
            ->add('productService')
            ->add('unitMeasurement', EntityType::class, [
                'class' => UnitMeasurement::class,
                'choice_label' => 'UnitOfMeasurement',
            ])
            ->add('ivaApplication', EntityType::class, [
                'class' => IvaApplication::class,
                'choice_label' => 'ivaApplication',
            ])
            ->add('grossPrice')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductService::class,
        ]);
    }
}
