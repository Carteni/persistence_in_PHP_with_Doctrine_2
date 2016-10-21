<?php

namespace AppBundle\Entity;

use AppBundle\Model\Geo\Coordinate;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Meetup
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 */
class Meetup
{
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
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var Coordinate
     *
     * @ORM\Column(type="coordinates")
     */
    protected $location;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Meetup
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set location
     *
     * @param Coordinate $location
     *
     * @return Meetup
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return Coordinate
     */
    public function getLocation()
    {
        return $this->location;
    }
}
