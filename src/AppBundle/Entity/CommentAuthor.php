<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CommentAuthor
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 */
class CommentAuthor extends \AppBundle\Entity\Author {

  /**
   * @var ArrayCollection $comments
   *
   * @ORM\OneToMany(targetEntity="Comment", mappedBy="author")
   */
  protected $comments;

  public function __construct() {
    $this->comments = new ArrayCollection();
  }

  /**
   * Add comment
   *
   * @param \AppBundle\Entity\Comment $comment
   *
   * @return CommentAuthor
   */
  public function addComment(\AppBundle\Entity\Comment $comment) {
    $this->comments->add($comment);
    $comment->setAuthor($this);
    return $this;
  }

  /**
   * Remove comment
   *
   * @param \AppBundle\Entity\Comment $comment
   */
  public function removeComment(\AppBundle\Entity\Comment $comment) {
    $this->comments->removeElement($comment);
  }

  /**
   * Get comments
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getComments() {
    return $this->comments;
  }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return CommentAuthor
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }
}
