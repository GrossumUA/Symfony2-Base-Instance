<?php
namespace Application\Sonata\AdminBundle\AdminTraits;

use Sonata\AdminBundle\Route\RouteCollection;

trait DisabledFunctionToRemoveAndCreateTrait
{
    use DisabledFunctionToRemoveTrait {
        configureRoutes as configureRoutesDisabledRemove;
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $this->configureRoutesDisabledRemove($collection);
        $collection->remove('create');
    }
}
