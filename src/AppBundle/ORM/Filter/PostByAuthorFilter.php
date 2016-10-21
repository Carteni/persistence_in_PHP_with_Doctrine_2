<?php

namespace AppBundle\ORM\Filter;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

/**
 * Class PostByAuthorFilter
 * @package AppBundle\ORM\Filter
 */
class PostByAuthorFilter extends SQLFilter
{

    /**
     * Gets the SQL query part to add to a query.
     *
     * @param ClassMetaData $targetEntity
     * @param string $targetTableAlias
     *
     * @return string The constraint SQL if there is available, empty string otherwise.
     */
    public function addFilterConstraint(
      ClassMetadata $targetEntity,
      $targetTableAlias
    ) {
        //$class = $targetEntity->reflClass->getName();
        if($targetEntity->reflClass->getName() === 'AppBundle\Entity\Post') {
            return $targetTableAlias.'.author_id = 2';
        }
        return '';
    }
}