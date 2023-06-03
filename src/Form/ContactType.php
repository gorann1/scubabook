<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',  TextType::class, array('label' => 'Ime', 'attr' => array('class' => '
            form-control block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-sky-600 focus:outline-none
            ')))
            ->add('subject', TextType::class, array('label'=> 'Naslov', 'attr' => array('class' => '
            form-control block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-sky-600 focus:outline-none
            ')))
            ->add('email',  EmailType::class, array('label' => 'Email', 'attr' => array('class' => '
            form-control block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-sky-600 focus:outline-none
            ')))
            ->add('message', TextareaType::class, array('label' => 'Tekst poruka','attr' => array('class' => '
             form-control
                block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-sky-600 focus:outline-none
            ')))
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Slažem se s GDPR-om',
                'attr' => array('class' => '
                form-check-input 
                appearance-none 
                h-4 
                w-4 
                border 
                border-gray-300 
                rounded-sm 
                bg-white 
                checked:bg-sky-600 
                checked:border-sky-600 
                focus:outline-none 
                transition 
                duration-200 
                mt-1 
                align-top 
                bg-no-repeat 
                bg-center 
                bg-contain 
                mr-2 
                cursor-pointer
                '),
                'mapped'    => false,
                'required'  => false,
            ])
            ->add('submit',  SubmitType::class, array('label' => 'Potvrdi', 'attr' => array('class' => '
            w-full
              px-6
              py-16.5
              bg-sky-600
              text-white
              font-medium
              text-xs
              leading-tight
              uppercase
              rounded
              shadow-md
              hover:bg-sky-700 hover:shadow-lg
              focus:bg-sky-700 focus:shadow-lg focus:outline-none focus:ring-0
              active:bg-sky-800 active:shadow-lg
              transition
              duration-150
              ease-in-out
            ')))
//            ->add('createdAt')
//            ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'        => Contact::class,
            'csrf_protection'   => true,
            'csrf_field_name'   => '_token',
            'csrf_token_id'     => 'contact_item'

        ]);
    }
}
