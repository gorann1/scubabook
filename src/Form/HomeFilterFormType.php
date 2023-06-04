<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Zone;
use App\Entity\Country;
use App\Entity\Region;
use App\Entity\City;
use App\Form\EventListener\DynamicFieldsSubscriber;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('region',  EntityType::class, [
                'class' => Region::class,
                'choice_label' => 'name',
                'placeholder' => ''])
        ;
        $formModifier = function (FormInterface $form, Region $region = null) {
            $cities = null === $region ? [] : $region->getAvailableCities();

            $form->add('city', EntityType::class, [
                'class' => City::class,
                'placeholder' => '',
                'choices' => $cities,
            ]);
        };

        $builder->get('region')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $region = $event->getForm()->getData();

                $formModifier($event->getForm()->getParent(), $region);
            }
        );

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
