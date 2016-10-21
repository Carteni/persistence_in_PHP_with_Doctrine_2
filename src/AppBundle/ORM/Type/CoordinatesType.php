<?php

namespace AppBundle\ORM\Type;

use AppBundle\Model\Geo\Coordinate;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 *
 * http://symfony2.ylly.fr/add-new-data-type-in-doctrine-2-in-symfony-2-jordscream/
 *
 * Class CoordinatesType
 * @package AppBundle\ORM\Type
 */
class CoordinatesType extends Type
{
    const COORDINATES = 'coordinates';

    /**
     * Gets the SQL declaration snippet for a field of this type.
     *
     * @param array $fieldDeclaration The field declaration.
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform The currently used database platform.
     *
     * @return string
     */
    public function getSQLDeclaration(
      array $fieldDeclaration,
      AbstractPlatform $platform
    ) {
        return $platform->getDoctrineTypeMapping('TINYTEXT');
    }

    /**
     * Gets the name of this type.
     *
     * @return string
     *
     * @todo Needed?
     */
    public function getName()
    {
        return self::COORDINATES;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if(!$value instanceof Coordinate) {
            throw new UnexpectedTypeException($value, 'AppBundle\ORM\Type\CoordinatesType');
        }

        return $value;
    }
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Coordinate::createFromString($value);
    }
}