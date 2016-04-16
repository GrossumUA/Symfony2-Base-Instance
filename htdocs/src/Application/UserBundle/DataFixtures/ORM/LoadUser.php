<?php

namespace Application\UserBundle\DataFixtures\ORM;

use Application\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Monolog\Registry;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUser extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /** @var  Registry */
    private $doctrine;

    /** @var ContainerInterface */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->doctrine = $container->get('doctrine');
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->createAdminUser($manager);
    }

    /**
     * @param ObjectManager $manager
     * @return User
     */
    private function createAdminUser(ObjectManager $manager)
    {
        $adminEmail = 'admin@admin.com';
        $adminPassword = 'admin';
        $adminUserName = 'admin';

        $userManager = $this->container->get('application_user.user.manager');

        /** @var User $user */
        $user = $userManager->createUser();
        $user->setUsername($adminUserName)
            ->setEmail($adminEmail)
            ->setPlainPassword($adminPassword)
            ->setEnabled(true)
            ->setRoles(['ROLE_SUPER_ADMIN']);

        $userManager->updateUser($user);

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
