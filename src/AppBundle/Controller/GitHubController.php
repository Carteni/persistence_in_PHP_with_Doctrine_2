<?php

namespace AppBundle\Controller;

use Guzzle\Http\Client;
use Guzzle\Http\Message\RequestInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GitHubController
 * @package AppBundle\Controller
 */
class GitHubController extends Controller
{
    /**
     * @return \AppBundle\Security\GitHub\AuthorizeRedirectResponse
     */
    public function ghAuthorizeAction()
    {
        return $this->get('app.github.authorize.redirect_response')->getResponse();
    }

    public function ghLoginAction(Request $request)
    {
        $client = new Client('https://github.com/login/oauth/access_token');
        /**
         * @var RequestInterface
         */
        $req = $client->post(
          '',
          null,
          [
            'client_id' => '03d687dee778a74bda17',
            'client_secret' => '6e46fcd7bd01d6bfb8dfff1c3045484c6816f42b',
            'code' => $request->query->get('code'),
          ]
        );
        $req->setHeader('Accept', 'application/json');

        $res = $req->send()->json();

        $token = $res['access_token'];

        $client = new Client('https://api.github.com');
        $req = $client->get('/user');
        $req->getQuery()->set('access_token', $token);
        $username = $req->send()->json()['login'];

        return new Response($username);
    }

}