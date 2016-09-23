<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TagType
 * @package AppBundle\Form\Type
 */
class TagType extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('name');
  }

  /**
   * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
   */
  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults(array(
      'data_class' => 'AppBundle\Entity\Tag'
    ));
  }
}