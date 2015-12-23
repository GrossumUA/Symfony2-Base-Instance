<?php

namespace Application\Sonata\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationSonataAdminBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'SonataAdminBundle';
    }
}
