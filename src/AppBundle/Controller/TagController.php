<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class TagController
 * @package AppBundle\Controller
 */
class TagController extends Controller {

  /**
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function listAction() {

    $tags = $this->getDoctrine()->getRepository('AppBundle:Tag')->findAll();

    return $this->render(':tag:index.html.twig', array(
      'tags' => $tags
    ));
  }

  /**
   * @param \AppBundle\Entity\Tag $tag
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function deleteAction(Tag $tag) {
    $em = $this->getDoctrine()->getManager();
    $em->remove($tag);
    $em->flush();

    return $this->redirectToRoute('tag.list');
  }

}