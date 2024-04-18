<?php

namespace App\Form\DeviceEvent;

use App\Entity\DeviceEvent\TemperatureExceededEvent;
use App\Form\DeviceEvent\DeviceEventType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TemperatureExceededEventType extends DeviceEventType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('temp', NumberType::class)
            ->add('treshold', NumberType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => TemperatureExceededEvent::class,
        ]);
    }
}
