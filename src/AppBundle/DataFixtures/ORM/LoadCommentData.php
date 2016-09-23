<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadCommentData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadCommentData implements FixtureInterface, DependentFixtureInterface {

  const NUMBER_OF_COMMENTS_BY_POST = 5;

  /**
   * This method must return an array of fixtures classes
   * on which the implementing class depends on
   *
   * @return array
   */
  function getDependencies() {
    return ['AppBundle\DataFixtures\ORM\LoadPostData'];
  }

  /**
   * Load data fixtures with the passed EntityManager
   *
   * @param ObjectManager $manager
   */
  public function load(ObjectManager $manager) {
    $posts = $manager->getRepository('AppBundle:Post')->findAll();
    foreach ($posts as $post) {
      for ($i = 1; $i <= self::NUMBER_OF_COMMENTS_BY_POST; $i++) {
        $comment = new Comment();
        $comment->setBody(<<<EOT
Lorem ipsum dolor sit amet, consectetur adipiscing elit.
EOT
        )
          ->setPublicationDate(new \DateTime(
            sprintf('-%d days', self::NUMBER_OF_COMMENTS_BY_POST - $i)
          ))
          ->setPost($post);
        $manager->persist($comment);
      }
    }

    $manager->flush();
  }
}