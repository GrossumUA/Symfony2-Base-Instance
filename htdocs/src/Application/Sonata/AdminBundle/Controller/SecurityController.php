<?php

namespace Application\Sonata\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        if ($user instanceof UserInterface) {
            return $this->redirect($this->generateUrl('sonata_admin_dashboard'));
        }

        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session\ */

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }
        if ($error) {
            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
            $error = $error->getMessage();
        }

        $csrfToken = $this->container->has('form.csrf_provider')
            ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
            : null;

//        if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
//            $refererUri = $request->server->get('HTTP_REFERER');
//            return new RedirectResponse($refererUri && $refererUri != $request->getUri() ? $refererUri : $this->container->get('router')->generate('sonata_admin_dashboard'));
//        }

        return $this->render('ApplicationSonataAdminBundle:security:login.html.twig',
            [
                'error'         => $error,
                'csrf_token'    => $csrfToken,
                'admin_pool'      => $this->container->get('sonata.admin.pool'),
                'base_template' => $this->container->get('sonata.admin.pool')->getTemplate('layout'),
            ]
        );



    }
}
