<?php

namespace AppBundle\Security\Http\EntryPoint;

use AppBundle\Security\GitHub\AuthorizeRedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Http\HttpUtils;

/**
 * Class OAuthEntryPoint
 * @package AppBundle\Security\Http\EntryPoint
 */
class OAuthEntryPoint implements AuthenticationEntryPointInterface
{
    /**
     * @var AuthorizeRedirectResponse
     */
    protected $authorizeRedirectResponse;

    /**
     * @var HttpKernelInterface
     */
    protected $httpKernel;

    /**
     * @var HttpUtils
     */
    protected $httpUtils;

    /**
     * @var string
     */
    protected $loginPath;

    /**
     * @var string
     */
    protected $client_id;

    /**
     * @var Boolean
     */
    protected $useForward;

    /**
     * OAuthEntryPoint constructor.
     * @param $authorizeRedirectResponse
     * @param bool|false $useForward
     */
    public function __construct(
      $authorizeRedirectResponse,
      $useForward = false
    ) {
        /*$this->httpKernel = $kernel;
        $this->httpUtils = $httpUtils;
        $this->loginPath = $login_path;
        $this->client_id = $client_id;*/
        $this->authorizeRedirectResponse = $authorizeRedirectResponse;
        $this->useForward = (Boolean)$useForward;
    }

    /**
     * Returns a response that directs the user to authenticate.
     *
     * This is called when an anonymous request accesses a resource that
     * requires authentication. The job of this method is to return some
     * response that "helps" the user start into the authentication process.
     *
     * Examples:
     *  A) For a form login, you might redirect to the login page
     *      return new RedirectResponse('/login');
     *  B) For an API token authentication system, you return a 401 response
     *      return new Response('Auth header required', 401);
     *
     * @param Request $request The request that resulted in an AuthenticationException
     * @param AuthenticationException $authException The exception that started the authentication process
     *
     * @return Response
     */
    public function start(
      Request $request,
      AuthenticationException $authException = null
    ) {
        /*if ($this->useForward) {
            $subRequest = $this->httpUtils->createRequest(
              $request,
              $this->loginPath
            );
            $subRequest->query->add(
              $request->query->getIterator()->getArrayCopy()
            );

            $response = $this->httpKernel->handle(
              $subRequest,
              HttpKernelInterface::SUB_REQUEST
            );
            if (200 === $response->getStatusCode()) {
                $response->headers->set('X-Status-Code', 401);
            }

            return $response;
        }*/

        /*return $this->httpUtils->createRedirectResponse(
          $request,
          sprintf(
            'https://github.com/login/oauth/authorize?client_id=%s&redirect_uri=%s',
            $this->client_id,
            $this->httpUtils->generateUri($request, $this->loginPath)
          )
        );*/

        if ($this->useForward) {
            return $this->authorizeRedirectResponse->getForwardedResponse();
        }

        return $this->authorizeRedirectResponse->getResponse();
    }
}