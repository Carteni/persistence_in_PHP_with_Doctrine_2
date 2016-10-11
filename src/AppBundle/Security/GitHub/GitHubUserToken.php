<?php
namespace AppBundle\Security\GitHub;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * Class GitHubUserToken
 * @package AppBundle\Security\GitHub
 */
class GitHubUserToken extends AbstractToken
{
    private $credentials;

    public function __construct($user, $credentials, array $roles = array())
    {
        parent::__construct($roles);

        $this->setUser($user);
        $this->credentials = $credentials;

        // If the user has roles, consider it authenticated
        parent::setAuthenticated(count($roles) > 0);
    }

    /**
     * Returns the user credentials.
     *
     * @return mixed The user credentials
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    public function setCredentials($email)
    {
        $this->credentials = $email;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize(
          array(
            $this->credentials,
            parent::serialize(),
          )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        list($this->credentials, $parentStr) = unserialize(
          $serialized
        );
        parent::unserialize($parentStr);
    }
}