<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class CommentController
 * @package AppBundle\Controller
 */
class CommentController extends Controller {

  /**
   * @param \AppBundle\Entity\Comment $comment
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function byPostDeleteAction(Comment $comment) {
    $this->removeComment($comment);
    return $this->redirectToRoute('post.show',
      array('id' => $comment->getPost()->getId()));
  }

  /**
   * @param \AppBundle\Entity\Comment $comment
   */
  protected function removeComment(Comment $comment) {
    $em = $this->getDoctrine()->getManager();
    $em->remove($comment);
    $em->flush();
  }
}