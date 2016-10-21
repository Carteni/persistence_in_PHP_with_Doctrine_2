<?php

namespace AppBundle\ORM\Type;

use AppBundle\Entity\Meetup;
use AppBundle\Model\Geo\Coordinate;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ORMCoordinatesTypeTest
 * @package AppBundle\ORM\Type
 */
class ORMCoordinatesTypeTest extends WebTestCase
{
    public function testMapping()
    {
        $client = static::createClient();
        $em = $client->getContainer()->get('doctrine.orm.entity_manager');

        $meetup = new Meetup();
        $name = uniqid();
        $meetup->setName($name);
        $meetup->setLocation(new Coordinate(33,75));

        $em->persist($meetup);
        $em->flush();

        $repo = $client->getContainer()->get('doctrine')
          ->getRepository('AppBundle:Meetup');
        $meet = $repo->findOneBy(array('name' => $name));

        $this->assertTrue($meet->getLocation() instanceof Coordinate);
        $this->assertTrue($meet->getLocation()->getLatitude() === 33);
        $this->assertTrue($meet->getLocation()->getLongitude() === 75);
    }
}