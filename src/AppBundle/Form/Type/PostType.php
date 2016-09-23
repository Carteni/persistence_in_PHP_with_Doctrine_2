<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PostType
 * @package AppBundle\Form\Type
 */
class PostType extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
      ->add('title', TextType::class)
      ->add('body', TextareaType::class)
      ->add('publicationDate', DateType::class, array(
          'widget' => 'single_text',
          'empty_data' => new \DateTime(),
        )
      )
      ->add('tags', CollectionType::class, array(
        'entry_type' => TagType::class,
        'allow_add' => TRUE,
        'allow_delete' => TRUE,
        'by_reference' => FALSE
        // Forza la chiamata dei metodi Post::addTag/removeTag
      ))
      ->add('save', SubmitType::class, array(
        'label' => 'Save'
      ));
  }

  /**
   * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
   */
  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults(array(
      'data_class' => 'AppBundle\Entity\Post'
    ));
  }
}