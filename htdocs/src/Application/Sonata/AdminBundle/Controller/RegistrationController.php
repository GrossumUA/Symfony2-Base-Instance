<?php

namespace Application\Sonata\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

use FOS\UserBundle\Controller\RegistrationController as BaseRegistrationController;

use Application\UserBundle\Entity\User;
use Application\UserBundle\Form\Type\RegistrationFormType;

class RegistrationController extends BaseRegistrationController
{
    /**
     * @return RedirectResponse|Response
     */
    public function registerAction()
    {
        $form = $this->container->get('application.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

        $process = $formHandler->process($confirmationEnabled);
        if ($process) {
            $user = $form->getData();

            $this->setFlash('fos_user_success', 'registration.flash.user_created');
            $url = $this->container->get('router')->generate('sonata_admin_dashboard');
            $response = new RedirectResponse($url);

            $this->authenticateUser($user, $response);

            return $response;
        }

        return $this->container->get('templating')->renderResponse(
            'ApplicationUserBundle:Registration:register.html.twig',
            [
                'form' => $form->createView(),
                'admin_pool'    => $this->container->get('sonata.admin.pool'),
                'base_template' => $this->container->get('sonata.admin.pool')->getTemplate('layout'),
            ]
        );
    }
}
