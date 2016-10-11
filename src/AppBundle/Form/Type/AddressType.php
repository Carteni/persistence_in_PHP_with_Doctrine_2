<?php
namespace AppBundle\Form\Type;

use AppBundle\Model\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AddressType
 * @package AppBundle\Form\Type
 */
class AddressType extends AbstractType
{
    protected $states = [
      'AL' => 'Alabama',
      'WY' => 'Wyoming'
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('street', TextType::class)
            ->add('country', ChoiceType::class, array(
                'choices' => array(
                    'US' => 'USA',
                    'OTHER' => 'Not USA',
                )
            ));

        $builder->addEventListener(FormEvents::PRE_SET_DATA,
          function(FormEvent $event) {

              /**
               * @var Address $address
               */
              $address = $event->getData();
              $form = $event->getForm();

              if($address->getCountry() === 'USA') {
                  $form->add('state', ChoiceType::class, array(
                    'choices' => $this->states
                  ));
              }
          });

        $builder->addEventListener(FormEvents::PRE_SUBMIT,
          function(FormEvent $event){

              $form = $event->getForm();

              $address = $event->getData();

              if($address['country'] === 'USA') {
                  $form->add('state', ChoiceType::class, array(
                    'choices' => $this->states
                  ));
              }
          });

        $builder->get('country')->addEventListener(FormEvents::POST_SUBMIT,
          function(FormEvent $event){

              $form = $event->getForm()->getParent();
              $country = $event->getForm()->getData();

              if($country === 'USA') {
                  $form->add('state', ChoiceType::class, array(
                    'choices' => $this->states
                  ));
              }
          }
          );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Model\Address',
            'label' => false
        ));

    }

}