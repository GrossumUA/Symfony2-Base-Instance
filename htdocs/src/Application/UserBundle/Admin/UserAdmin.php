<?php

namespace Application\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

use Application\UserBundle\Entity\EntityManager\UserManager;
use Application\UserBundle\Entity\User;

class UserAdmin extends Admin
{
    const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * @var UserManager $userManager
     */
    protected $userManager;

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username', null, ['label' => 'Username', 'required' => true])
            ->add('email', 'email', ['label' => 'Email', 'required' => true])
            ->add(
                'plainPassword',
                'password',
                [
                    'label' => 'Password',
                    'always_empty' => true,
                    'required' => ($this->getSubject() && $this->getSubject()->getId())? false : true
                ]
            )
            ->add('enabled', null, ['label' => 'Enabled', 'required' => false])
            ->add('locked', null, ['label' => 'Locked', 'required' => false]);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('email')
            ->add('username')
            ->add('enabled')
            ->add('locked');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('email')
            ->add('username')
            ->add('enabled')
            ->add('locked');
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($user)
    {
        $this->setMainFields($user);
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($user)
    {
        $this->setMainFields($user);
    }

    /**
     * {@inheritdoc}
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        $userByEmail = $this->userManager->findUserByEmail($object->getEmail());

        if ($userByEmail && $userByEmail->getId() != $object->getId()) {
            $errorElement
                ->with('email')
                ->addViolation('Email already exist')
                ->end();
        }

        $userByUsername = $this->userManager->findUserByUsername($object->getUsername());

        if ($userByUsername && $userByUsername->getId() != $object->getId()) {
            $errorElement
                ->with('username')
                ->addViolation('Username already exist')
                ->end();
        }
    }

    /**
     * @param UserManager $userManager
     */
    public function setUserManager(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @param User $user
     */
    private function setMainFields(User $user)
    {
        if ($user->getPlainPassword()) {
            $this->userManager->updatePassword($user);
        }
        if (!$user->hasRole(static::ROLE_ADMIN)) {
            $user->addRole(static::ROLE_ADMIN);
        }
    }
}
