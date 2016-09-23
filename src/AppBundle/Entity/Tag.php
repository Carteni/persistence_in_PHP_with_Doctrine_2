<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Tag
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(
 *   uniqueConstraints={
 *      @ORM\UniqueConstraint(name="name_idx", columns={"name"})
 *   }
 * )
 *
 */
class Tag {

  /**
   * @var int
   *
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  protected $id;

  /**
   * @var string
   *
   * @ORM\Column(type="string", length=180)
   */
  protected $name;

  /**
   * @var ArrayCollection $posts
   *
   * @ORM\ManyToMany(targetEntity="Post", mappedBy="tags")
   */
  protected $posts;

  public function __construct() {
    $this->posts = new ArrayCollection();
  }

  /**
   * @return string
   */
  public function __toString() {
    return $this->getName();
  }

  /**
   * Get name
   *
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Set name
   *
   * @param string $name
   *
   * @return Tag
   */
  public function setName($name) {
    $this->name = $name;

    return $this;
  }

  /**
   * Add post
   *
   * @param \AppBundle\Entity\Post $post
   *
   * @return Tag
   */
  public function addPost(\AppBundle\Entity\Post $post) {
    $this->posts[] = $post;
    $post->addTag($this);

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
   * Get id
   *
   * @return \int
   */
  public function getId() {
    return $this->id;
  }
}
