<?php

namespace AppBundle\Security\GitHub;

use Guzzle\Http\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Firewall\AbstractAuthenticationListener;

/**
 * Class AuthenticationListener
 * @package AppBundle\Security\GitHub
 */
class AuthenticationListener extends AbstractAuthenticationListener
{
    protected $client_id;
    protected $client_secret;

    public function setKeys($client_id, $client_secret)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }

    /**
     * Performs authentication.
     *
     * @param Request $request A Request instance
     *
     * @return TokenInterface|Response|null The authenticated token, null if full authentication is not possible, or a Response
     *
     * @throws AuthenticationException if the authentication fails
     */
    protected function attemptAuthentication(Request $request)
    {
        $client = new Client('https://github.com/login/oauth/access_token');
        $req = $client->post(
          '',
          null,
          [
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'code' => $request->query->get('code'),
          ]
        );
        $req->setHeader('Accept', 'application/json');

        $res = $req->send()->json();

        $token = $res['access_token'];

        $client = new Client('https://api.github.com');
        $req = $client->get('/user');
        $req->getQuery()->set('access_token', $token);

        $data = $req->send()->json();
        $username = $data['login'];
        $email = $data['id'].'@github.com';

        $unauthenticatedToken = new GitHubUserToken($username, $email);

        return $this->authenticationManager->authenticate(
          $unauthenticatedToken
        );
    }
}