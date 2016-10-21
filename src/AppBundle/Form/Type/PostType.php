<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Post;
use Application\Sonata\MediaBundle\Entity\GalleryHasMedia;
use Application\Sonata\MediaBundle\Entity\Media;
use Sonata\MediaBundle\Entity\MediaManager;
use Sonata\MediaBundle\Form\Type\MediaType;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PostType
 * @package AppBundle\Form\Type
 */
class PostType extends AbstractType
{
    /**
     * @var MediaManager
     */
    protected $manager;

    /**
     * @var MediaInterface
     */
    protected $galleryHasMedia;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('title', TextType::class)
          ->add('body', TextareaType::class)
          ->add(
            'publicationDate',
            DateType::class,
            array(
              'widget' => 'single_text',
              'empty_data' => new \DateTime(),
            )
          )
          ->add(
            'poster',
            MediaType::class,
            array(
              'provider' => 'sonata.media.provider.image',
              'context' => 'post',
            )
          )
          ->add(
            'gallery',
            EntityType::class,
            array(
                'class' => 'Application\Sonata\MediaBundle\Entity\Gallery',
                'choice_label' => 'name'

            )
          )
          ->add(
            'galleryHasMedia',
            MediaType::class,
            array(
              'provider' => 'sonata.media.provider.image',
              'context' => 'post',
              'mapped' => false,
            )
          )
          ->add(
            'tags',
            CollectionType::class,
            array(
              'entry_type' => TagType::class,
              'allow_add' => true,
              'allow_delete' => true,
              'by_reference' => false
                // Forza la chiamata dei metodi Post::addTag/removeTag
            )
          )
          ->add(
            'save',
            SubmitType::class,
            array(
              'label' => 'Save',
            )
          );

        $builder->addEventListener(
          FormEvents::PRE_SUBMIT,
          function (FormEvent $event) {

              $data = $event->getData();

              if (!is_null($data['galleryHasMedia']['binaryContent'])) {
                  $media = new Media();
                  $media->setBinaryContent(
                    $data['galleryHasMedia']['binaryContent']
                  );
                  $media->setContext('post');
                  $media->setProviderName('sonata.media.provider.image');
                  $this->manager->save($media);

                  //$this->manager->getEntityManager()->refresh($media);

                  $this->galleryHasMedia = $media;
              }
          }
        );

        $builder->addEventListener(
          FormEvents::POST_SUBMIT,
          function (FormEvent $event) {

              if (!is_null($this->galleryHasMedia)) {
                  /**
                   * @var Post $post ;
                   */
                  $post = $event->getData();

                  $media = new GalleryHasMedia();
                  $media->setGallery($post->getGallery());
                  $media->setMedia($this->galleryHasMedia);
                  $media->setEnabled(true);
                  $this->manager->getEntityManager()->persist($media);
              }

          }
        );
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
          array(
            'data_class' => 'AppBundle\Entity\Post',
          )
        );
    }
}