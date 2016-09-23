<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Post;
use AppBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadTagData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadTagData implements FixtureInterface, DependentFixtureInterface {

  const NUMBER_OF_TAGS = 5;

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
    $tags = [];
    for ($i = 1; $i <= self::NUMBER_OF_TAGS; $i++) {
      $tag = new Tag();
      $tag->setName(sprintf("tag%d", $i));
      $tags[] = $tag;
    }

    $posts = $manager->getRepository('AppBundle:Post')->findAll();
    $tagsToAdd = 1;
    /**
     * @var Post $post
     */
    foreach ($posts as $post) {
      for ($j = 0; $j < $tagsToAdd; $j++) {
        $post->addTag($tags[$j]);
      }
      $tagsToAdd = $tagsToAdd % 5 + 1;
    }
    $manager->flush();
  }
}