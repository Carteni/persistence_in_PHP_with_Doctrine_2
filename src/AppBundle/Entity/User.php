<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 */
class User extends BaseUser {

  /**
   * @var int
   *
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  protected $id;

  public function __construct() {
    parent::__construct();
  }

  /**
   * @Assert\IsTrue(groups={"edit_post"})
   *
   * @return int
   */
  public function isUsernameBeginWith()
  {
    return preg_match('/^car/i',$this->getUsername());
  }
}