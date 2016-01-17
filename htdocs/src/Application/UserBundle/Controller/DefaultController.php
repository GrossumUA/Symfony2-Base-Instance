<?php

namespace Application\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @param string $name
     * @return Response
     */
    public function indexAction($name)
    {
        return $this->render('ApplicationUserBundle:Default:index.html.twig', ['name' => $name]);
    }
}
