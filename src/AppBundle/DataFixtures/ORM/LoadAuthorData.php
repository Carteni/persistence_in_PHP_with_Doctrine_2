<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Comment;
use AppBundle\Entity\CommentAuthor;
use AppBundle\Entity\Post;
use AppBundle\Entity\PostAuthor;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadAuthorData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadAuthorData implements FixtureInterface {

  /**
   * Load data fixtures with the passed EntityManager
   *
   * @param ObjectManager $manager
   */
  public function load(ObjectManager $manager) {

    $postAuthor = new PostAuthor();
    $postAuthor->setName('George Abitbol');
    $postAuthor->setEmail('gabitbol@example.com');
    $postAuthor->setBio('L\'homme le plus classe du monde');
    $manager->persist($postAuthor);

    $post = new Post();
    $post->setTitle('My post');
    $post->setBody('Lorem ipsum');
    $post->setPublicationDate(new \DateTime());
    $post->setAuthor($postAuthor);
    $manager->persist($post);

    $commentAuthor = new CommentAuthor();
    $commentAuthor->setName('Kévin Dunglas');
    $commentAuthor->setEmail('dunglas@gmail.com');
    $manager->persist($commentAuthor);

    $comment = new Comment();
    $comment->setBody('My comment');
    $comment->setAuthor($commentAuthor);
    $comment->setPublicationDate(new \DateTime());
    $post->addComment($comment);
    $manager->persist($comment);

    $manager->flush();
  }
}