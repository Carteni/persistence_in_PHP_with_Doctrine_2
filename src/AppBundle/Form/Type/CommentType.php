<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CommentType
 * @package AppBundle\Form\Type
 */
class CommentType extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
      ->add('body', TextareaType::class)
      ->add('publicationDate', DateTimeType::class, array(
          'widget' => 'single_text',
          'empty_data' => new \DateTime()
        )
      )
      ->add('save', SubmitType::class, array(
        'label' => 'Add Comment'
      ));
  }

  /**
   * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
   */
  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults(array(
      'data_class' => 'AppBundle\Entity\Comment'
    ));
  }
}