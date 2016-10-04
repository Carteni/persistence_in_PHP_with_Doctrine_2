<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;
use AppBundle\Form\Type\CommentType;
use AppBundle\Form\Type\PostType;
use Doctrine\ORM\UnitOfWork;
use Predis\ClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter as pc;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends Controller {
  /**
   * @param \Symfony\Component\HttpFoundation\Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function indexAction(Request $request) {

    $posts = $this
      ->getDoctrine()
      ->getRepository('AppBundle:Post')
      ->findWithCommentCount();

    $this->get('snc_redis.default')->incr('foo:bar');

    $this->get('app.post_repository')
      ->getDefaultCache()->del('foo:bar');

    // replace this example code with whatever you need
    return $this->render(':post:index.html.twig', [
      'posts' => $posts,
      'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
    ]);
  }

  /**
   * @param \AppBundle\Entity\Post $post
   * @param \Symfony\Component\HttpFoundation\Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   */
  public function editAction(Post $post, Request $request) {
    $form = $this->createForm(PostType::class, $post, array(
      'method' => 'PUT'
    ));
    if ($this->process($form, $post, $request)) {
      return $this->redirectToRoute('homepage');
    }
    return $this->render(':post:edit.html.twig', array(
      'form' => $form->createView(),
      'post' => $post
    ));
  }

  /**
   * @param \Symfony\Component\Form\Form $form
   * @param \AppBundle\Entity\Post $post
   * @param \Symfony\Component\HttpFoundation\Request $request
   * @return bool|\Symfony\Component\HttpFoundation\RedirectResponse
   */
  protected function process(Form $form, Post $post, Request $request) {
    $processed = FALSE;
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($post);


      /**
       * @var UnitOfWork $uow
       */
      $uow = $em->getUnitOfWork();
      $uow->computeChangeSets();
      if ($uow->isEntityScheduled($post)) {
        // My entity has changed
        $changed = TRUE;
      }
      $em->flush();

      /**
       * @var ClientInterface $cacheDriver
       */
      $client = $this->get('snc_redis.doctrine');
      $client->del(array("[".md5('postWithComments')."][1]"));

      $processed = TRUE;
    }
    return $processed;
  }

  /**
   * @param \Symfony\Component\HttpFoundation\Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   */
  public function createAction(Request $request) {
    $post = new Post();
    $post->setPublicationDate(new \DateTime());
    $form = $this->createForm(PostType::class, $post, array(
      'method' => 'POST'
    ));
    if ($this->process($form, $post, $request)) {
      return $this->redirectToRoute('homepage');
    }
    return $this->render(':post:new.html.twig', array(
      'form' => $form->createView()
    ));
  }

  /**
   * @param \AppBundle\Entity\Post $post
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function deleteAction(Post $post) {
    $em = $this->getDoctrine()->getManager();
    $em->remove($post);
    $em->flush();
    return $this->redirectToRoute('homepage');
  }

  /**
   * @param \AppBundle\Entity\Post $post
   * @param \Symfony\Component\HttpFoundation\Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   *
   * @pc(
   *   "post",
   *   class="AppBundle\Entity\Post",
   *   options={
   *      "repository_method" = "findWithComments"
   *   }
   * )
   */
  public function showAction(Post $post, Request $request) {

    // Post comment.
    $comment = new Comment();
    $comment->setPublicationDate(new \DateTime());
    $comment->setPost($post);
    $form = $this->createForm(CommentType::class, $comment, array(
      'method' => 'POST'
    ));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($comment);
      $em->flush();
      return $this->redirectToRoute('post.show', array('id' => $post->getId()));
    }

    return $this->render(':post:show.html.twig', array(
      'post' => $post,
      'form' => $form->createView()
    ));
  }

  /**
   * @param $tag_names
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function showByTagsAction($tag_names) {
    $posts = $this->getDoctrine()->getRepository('AppBundle:Post')
      ->findHavingTags(explode('+', $tag_names));

    return $this->render(':post:index.html.twig', array(
      'posts' => $posts
    ));
  }
}
