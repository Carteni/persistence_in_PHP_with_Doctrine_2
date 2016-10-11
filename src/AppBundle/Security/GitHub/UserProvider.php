<?php

namespace AppBundle\Security\GitHub;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class UserProvider
 * @package AppBundle\Security\GitHub
 */
class UserProvider implements UserProviderInterface
{
    protected $user_manager;

    public function __construct($user_manager)
    {
        $this->user_manager = $user_manager;
    }

    public function loadOrCreateUser($username, $email)
    {
        $user = $this->loadUserByUsername($username);

        if (empty($user)) {
            $user = $this->user_manager->createUser();
            $user->setEnabled(true);
            $user->setRoles(array('ROLE_ADMIN'));
            $user->setPassword('');
            $user->setEmail($email);
            $user->setUsername($username);
        }

        $this->user_manager->updateUser($user);

        return $user;
    }

    /**
     * Loads the user for the given username.
     *
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @param string $username The username
     *
     * @return UserInterface
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByUsername($username)
    {
        return $this->user_manager->findUserByUsername($username);
    }

    /**
     * Refreshes the user for the account interface.
     *
     * It is up to the implementation to decide if the user data should be
     * totally reloaded (e.g. from the database), or if the UserInterface
     * object can just be merged into some internal array of users / identity
     * map.
     *
     * @param UserInterface $user
     *
     * @return UserInterface
     *
     * @throws UnsupportedUserException if the account is not supported
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$this->supportsClass(get_class($user)) || !$user->getEmail()) {
            throw new UnsupportedUserException(
              sprintf(
                'Instances of "%s" are not supported.',
                get_class($user)
              )
            );
        }

        return $this->loadUserByUsername($user->getEmail());
    }

    /**
     * Whether this provider supports the given user class.
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return $this->user_manager->supportsClass($class);
    }
}