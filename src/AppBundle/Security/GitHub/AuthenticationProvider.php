<?php
namespace AppBundle\Security\GitHub;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class AuthenticationProvider
 * @package AppBundle\Security\GitHub
 */
class AuthenticationProvider implements AuthenticationProviderInterface
{

    /**
     * @var UserProviderInterface
     */
    private $user_provider;

    public function __construct($user_provider)
    {
        $this->user_provider = $user_provider;
    }

    /**
     * Attempts to authenticate a TokenInterface object.
     *
     * @param TokenInterface $token The TokenInterface instance to authenticate
     *
     * @return TokenInterface An authenticated TokenInterface instance, never null
     *
     * @throws AuthenticationException if the authentication fails
     */
    public function authenticate(TokenInterface $token)
    {
        $username = $token->getUsername();
        $email = $token->getCredentials();

        $user = $this->user_provider->loadOrCreateUser($username, $email);

        // Log the user in
        $authenticated_token = new GithubUserToken(
          $user,
          $email,
          $user->getRoles()
        );
        $authenticated_token->setAuthenticated(true);

        return $authenticated_token;
    }

    /**
     * Checks whether this provider supports the given token.
     *
     * @param TokenInterface $token A TokenInterface instance
     *
     * @return bool true if the implementation supports the Token, false otherwise
     */
    public function supports(TokenInterface $token)
    {
        return $token instanceof GitHubUserToken;
    }
}