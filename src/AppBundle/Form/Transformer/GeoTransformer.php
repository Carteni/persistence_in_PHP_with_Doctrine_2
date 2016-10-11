<?php

namespace AppBundle\Form\Transformer;

use AppBundle\Model\Geo\Coordinate;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class GeoTransformer
 * @package AppBundle\Form\Transformer
 */
class GeoTransformer implements DataTransformerInterface
{

    /**
     * {@inheritDoc}
     */
    public function transform($geo)
    {
        return $geo;
    }

    /**
     * Transforms a value from the transformed representation to its original
     * representation.
     *
     * This method is called when {@link Form::submit()} is called to transform the requests tainted data
     * into an acceptable format for your data processing/model layer.
     *
     * This method must be able to deal with empty values. Usually this will
     * be an empty string, but depending on your implementation other empty
     * values are possible as well (such as NULL). The reasoning behind
     * this is that value transformers must be chainable. If the
     * reverseTransform() method of the first value transformer outputs an
     * empty string, the second value transformer must be able to process that
     * value.
     *
     * By convention, reverseTransform() should return NULL if an empty string
     * is passed.
     *
     * @param mixed $latLong
     * @return mixed The value in the original representation
     *
     * @internal param mixed $value The value in the transformed representation
     *
     */
    public function reverseTransform($latLong)
    {
        return Coordinate::createFromString($latLong);
    }
}