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

    /**
     * @var ContainerInterface
     */
    private $container;


    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->doctrine = $container->get('doctrine');
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->createAdminUser($manager);
    }

    private function createAdminUser(ObjectManager $manager)
    {
        $adminEmail = 'admin@admin.com';
        $adminPassword = 'admin';
        $adminUserName = 'admin';

        $userManager = $this->container->get('application_user.user.manager');


        $user = new User();
        $user->setEmail($adminEmail);
        $user->setUsername($adminUserName);
        $user->setEnabled(true);
        $user->setLocked(false);
        $user->setSalt(md5(uniqid()));
        $user->setPlainPassword($adminPassword);
        $user->setRoles(['ROLE_SUPER_ADMIN']);

        $userManager->updatePassword($user);
        $userManager->updateCanonicalFields($user);

        $manager->persist($user);
        $manager->flush($user);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}