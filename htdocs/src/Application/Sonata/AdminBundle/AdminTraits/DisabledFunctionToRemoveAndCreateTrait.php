<?php
namespace Application\Sonata\AdminBundle\AdminTraits;

use Sonata\AdminBundle\Route\RouteCollection;

trait DisabledFunctionToRemoveAndCreateTrait
{
    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('delete');
    }
}