<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Comment
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 *
 */
class Comment {

  /**
   * @var int
   *
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   *
   */
  protected $id;

  /**
   * @var string
   *
   * @ORM\Column(type="text")
   *
   */
  protected $body;

  /**
   * @var \DateTime
   *
   * @ORM\Column(type="datetime")
   *
   */
  protected $publicationDate;

  /**
   * @var Post
   *
   * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
   * @ORM\JoinColumn(name="post_id", referencedColumnName="id", onDelete="CASCADE")
   */
  protected $post;

  /**
   * @var CommentAuthor $author
   *
   * @ORM\ManyToOne(targetEntity="CommentAuthor", inversedBy="comments")
   */
  protected $author;


  /**
   * Get id
   *
   * @return integer
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Get body
   *
   * @return string
   */
  public function getBody() {
    return $this->body;
  }

  /**
   * Set body
   *
   * @param string $body
   *
   * @return Comment
   */
  public function setBody($body) {
    $this->body = $body;

    return $this;
  }

  /**
   * Get publicationDate
   *
   * @return \DateTime
   */
  public function getPublicationDate() {
    return $this->publicationDate;
  }

  /**
   * Set publicationDate
   *
   * @param \DateTime $publicationDate
   *
   * @return Comment
   */
  public function setPublicationDate($publicationDate) {
    $this->publicationDate = $publicationDate;

    return $this;
  }

  /**
   * Get post
   *
   * @return \AppBundle\Entity\Post
   */
  public function getPost() {
    return $this->post;
  }

  /**
   * Set post
   *
   * @param \AppBundle\Entity\Post $post
   *
   * @return Comment
   */
  public function setPost(\AppBundle\Entity\Post $post = NULL) {
    $this->post = $post;

    return $this;
  }

    /**
     * Set author
     *
     * @param \AppBundle\Entity\CommentAuthor $author
     *
     * @return Comment
     */
    public function setAuthor(\AppBundle\Entity\CommentAuthor $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\CommentAuthor
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
