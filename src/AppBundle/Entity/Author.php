<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Author
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"post" = "PostAuthor", "comment" = "CommentAuthor"})
 */
abstract class Author {

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
   * @ORM\Column(type="text", length=180)
   */
  protected $name;

  /**
   * @var string
   * @ORM\Column(type="text", length=180)
   */
  protected $surname;

  /**
   * @var string
   *
   * @ORM\Column(type="text", length=180)
   */
  protected $email;

  /**
   * Get id
   *
   * @return integer
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * @return string
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * @param string $email
   */
  public function setEmail($email) {
    $this->email = $email;
  }

}
