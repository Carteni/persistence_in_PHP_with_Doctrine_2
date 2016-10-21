<?php
/**
 * Created by PhpStorm.
 * User: Fra
 * Date: 12/10/2016
 * Time: 15:06
 */

namespace AppBundle\EventListener;


use AppBundle\Entity\Post;
use Application\Sonata\MediaBundle\Entity\Gallery;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class PostEventListener
{
    /**
     * @var Slugify
     */
    protected $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }


    public function prePersist(LifecycleEventArgs $event) {

        $entity = $event->getEntity();

        if(!$entity instanceof Post) {
            return;
        }

        // Slugify
        $entity->setSlug($this->slugify->slugify($entity->getTitle()));

        /**
         * @var Gallery
         */
        $gallery = new Gallery();
        $gallery->setName(sprintf('%s gallery',$entity->getTitle()));
        $gallery->setContext('post');
        $gallery->setDefaultFormat('reference');
        $gallery->setEnabled(TRUE);
        $entity->setGallery($gallery);
    }

    public function preUpdate(PreUpdateEventArgs $event) {

        $entity = $event->getEntity();

        if(!$entity instanceof Post) {
            return;
        }

        /*$uow = $event->getEntityManager()->getUnitOfWork();
        $uow->propertyChanged($entity,'title',$entity->getTitle(),
          $entity->getTitle().'Fake');*/

        // Oppure
        //$entity->setTitle('Fake');

        // Slugify
        $entity->setSlug($this->slugify->slugify($entity->getTitle()));
    }
}