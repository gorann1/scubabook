<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Zone;
use App\Entity\Country;
use App\Entity\Region;
use App\Entity\City;
use App\Form\EventListener\DynamicFieldsSubscriber;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HomeFilterFormType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('zone', EntityType::class, [
                'class' => Zone::class,
                'placeholder' => '-- select a zone --',
            ])
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'placeholder' => '-- select a country --',
            ])
            ->add('region', EntityType::class, [
                'class' => Region::class,
                'placeholder' => '-- select a region --',
            ])
            ->add('city', EntityType::class, [
                'class' => City::class,
                'placeholder' => '-- select a city --',
            ])
        ;

        // Add listeners
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
