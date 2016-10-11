<?php

namespace AppBundle\Model\Geo;

use Ivory\GoogleMapBundle\Entity\Coordinate as GMapsCoordinate;

/**
 * Class Coordinate
 * @package AppBundle\Model\Geo
 */
class Coordinate
{
    private $latitude;
    private $longitude;

    public function __construct(
      $latitude = NULL,
      $longitude = NULL
    ) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public static function factory():Coordinate
    {
        return new self();
    }

    public static function createFromString($string)
    {
        if (strlen($string) < 1) {
            return new self;
        }
        $string = str_replace(['(', ')', ' '], '', $string);
        $data = explode(',', $string);
        if ($data[0] === "" || $data[1] === "") {
            return new self;
        }

        return new self($data[0], $data[1]);
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function __toString()
    {
        return '('.$this->latitude.', '.$this->longitude.')';
    }

    public function toGMaps()
    {
        return new GMapsCoordinate($this->latitude, $this->longitude);
    }

}