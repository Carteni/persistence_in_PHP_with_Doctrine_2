<?php

namespace AppBundle\Security\Annotation;

/**
 * @Annotation
 * 
 * Class ValidateUser
 * @package AppBundle\Security\Annotation
 */
class ValidateUser
{
    private $validationGroup;

    public function __construct(array $parameters)
    {
        $this->validationGroup = $parameters['value'];
    }

    /**
     * @return string
     */
    public function getValidationGroup()
    {
        return $this->validationGroup;
    }

}