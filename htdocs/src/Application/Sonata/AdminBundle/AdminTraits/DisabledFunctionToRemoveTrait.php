<?php
namespace Application\Sonata\AdminBundle\AdminTraits;

use Sonata\AdminBundle\Route\RouteCollection;

trait DisabledFunctionToRemoveTrait
{
    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('delete');
    }
}
