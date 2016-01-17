<?php

namespace Application\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class ApplicationUserBundle
 */
class ApplicationUserBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
