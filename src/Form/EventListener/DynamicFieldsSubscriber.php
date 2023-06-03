<?php

namespace App\Form\EventListener;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormInterface;
class DynamicFieldsSubscriber
{
    /**
 *
* /**
     * Define the events we need to subscribe
     * @return string[]
     */
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData', // check preSetData method below
            FormEvents::PRE_SUBMIT => 'preSubmitData', // check preSubmitData method below
        );
    }

    /**
     * Handling form fields before form renders.
     * @param FormEvent $event
     */
    public function preSetData(FormEvent $event)
    {
        $location = $event->getData();
        // Location is the main entity which is obviously form's (data_class)
        $form = $event->getForm();

        $zone = "";
        $country = "";
        $region = "";
        $city = "";

        if ($location) {
            // collect preliminary values for 3 fields.
            $country = $location->getCountry();
            $region = $location->getState();
            $city = $location->getDistrict();
        }
        // Add country field as its static.
        $form->add('country', 'entity', array(
            'class' => 'YourBundle:Country',
            'label' => 'Select Country',
            'empty_value' => ' -- Select Country -- ',
            'required' => true,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->where('c.status = ?1')
                    ->setParameter(1, 1);
            }
        ));
        // Now add all child fields.
        $this->addStateField($form, $country);
        $this->addDistrictField($form, $region);
        $this->addDistrictField($form, $city);
    }

    /**
     * Handling Form fields before form submits.
     * @param FormEvent $event
     */
    public function preSubmitData(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        // Here $data will be in array format.

        // Add property field if parent entity data is available.
        $country = isset($data['country']) ? $data['country'] : $data['country'];
        $region = isset($data['state']) ? $data['state'] : $data['state'];
        $city = isset($data['district']) ? $data['district'] : $data['district'];

        // Call methods to add child fields.
        $this->addStateField($form, $country);
        $this->addDistrictField($form, $region);
    }

    /**
     * Method to Add State Field. (first dynamic field.)
     * @param FormInterface $form
     * @param type $country
     */
    private function addStateField(FormInterface $form, $country = null)
    {
        $countryCode = (is_object($country)) ? $country->getCountryCode() : $country;
        // $countryCode is dynamic here, collected from the event based data flow.
        $form->add('state', 'entity', array(
            'class' => 'YourBundle:State',
            'label' => 'Select State',
            'empty_value' => ' -- Select State -- ',
            'required' => true,
            'attr' => array('class' => 'state'),
            'query_builder' => function (EntityRepository $er) use($countryCode) {
                return $er->createQueryBuilder('u')
                    ->where('u.countryCode = :countrycode')
                    ->setParameter('countrycode', $countryCode);
            }
        ));
    }

    /**
     * Method to Add District Field, (second dynamic field)
     * @param FormInterface $form
     * @param type $state
     */
    private function addDistrictField(FormInterface $form, $state = null)
    {
        $stateCode = (is_object($state)) ? $state->getStatecode() : $state;
        // $stateCode is dynamic in here collected from event based data flow.
        $form->add('district', 'entity', array(
            'class' => 'YourBundle:District',
            'label' => 'Select District',
            'empty_value' => ' -- Select District -- ',
            'required' => true,
            'attr' => array('class' => 'district'),
            'query_builder' => function (EntityRepository $er) use($stateCode) {
                return $er->createQueryBuilder('s')
                    ->where('s.stateCode = :statecode')
                    ->setParameter('statecode', $stateCode);
            }
        ));
    }


}
