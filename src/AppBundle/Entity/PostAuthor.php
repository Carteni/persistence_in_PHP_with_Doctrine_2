<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class PostAuthor
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 */
class PostAuthor extends Author {

  /**
   * @var string
   *
   * @ORM\Column(type="text", nullable=TRUE)
   */
  protected $bio;

  /**
   * @var ArrayCollection $posts
   *
   * @ORM\OneToMany(targetEntity="Post", mappedBy="author")
   */
  protected $posts;

  public function __construct() {
    $this->posts = new ArrayCollection();
  }

  /**
   * Get bio
   *
   * @return string
   */
  public function getBio() {
    return $this->bio;
  }

  /**
   * Set bio
   *
   * @param string $bio
   *
   * @return PostAuthor
   */
  public function setBio($bio) {
    $this->bio = $bio;

    return $this;
  }

  /**
   * Add post
   *
   * @param \AppBundle\Entity\Post $post
   *
   * @return PostAuthor
   */
  public function addPost(\AppBundle\Entity\Post $post) {
    $this->posts->add($post);
    $post->setAuthor($this);
    return $this;
  }

  /**
   * Remove post
   *
   * @param \AppBundle\Entity\Post $post
   */
  public function removePost(\AppBundle\Entity\Post $post) {
    $this->posts->removeElement($post);
  }

  /**
   * Get posts
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getPosts() {
    return $this->posts;
  }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return PostAuthor
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
