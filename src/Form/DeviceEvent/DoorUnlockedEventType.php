<?php

namespace App\Form\DeviceEvent;

use App\Entity\DeviceEvent\DoorUnlockedEvent;
use App\Form\DeviceEvent\DeviceEventType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoorUnlockedEventType extends DeviceEventType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('unlockDate', IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => DoorUnlockedEvent::class,
        ]);
    }
}
