<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class PostAuthorController
 * @package AppBundle\Controller
 */
class PostAuthorController extends Controller {

  public function indexAction() {
    $authors = $this
      ->getDoctrine()
      ->getRepository('AppBundle:PostAuthor')
      ->findAll();

    return $this->render(':author:post.html.twig', array(
      'authors' => $authors
    ));
  }

}