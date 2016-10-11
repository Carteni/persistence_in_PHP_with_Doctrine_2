<?php

namespace AppBundle\Security\GitHub;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Security\Http\HttpUtils;

/**
 * Class AuthorizeRedirectResponse
 * @package AppBundle\Security\GitHub
 */
class AuthorizeRedirectResponse
{
    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var Kernel
     */
    protected $kernel;

    /**
     * @var HttpUtils
     */
    protected $httpUtils;

    /**
     * @var string
     */
    protected $client_id;

    /**
     * @var string
     */
    protected $login_path;

    /**
     * @var string
     */
    protected $check_path;

    /**
     * AuthorizeRedirectResponse constructor.
     * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
     * @param $httpUtils
     * @param $kernel
     * @param $client_id
     * @param $login_path
     * @param $check_path
     */
    public function __construct(
      RequestStack $requestStack,
      $httpUtils,
      $kernel,
      $client_id,
      $login_path,
      $check_path
    ) {
        $this
          ->setRequestStack($requestStack)
          ->setHttpUtils($httpUtils)
          ->setKernel($kernel)
          ->setClientId($client_id)
          ->setLoginPath($login_path)
          ->setCheckPath($check_path);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function getResponse()
    {
        return new RedirectResponse(
          sprintf(
            'https://github.com/login/oauth/authorize?client_id=%s&redirect_uri=%s',
            $this->getClientId(),
            $this->getHttpUtils()->generateUri(
              $this->getRequestStack()->getCurrentRequest(),
              $this->getCheckPath()
            )
          )
        );
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param string $client_id
     * @return AuthorizeRedirectResponse
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;

        return $this;
    }

    /**
     * @return HttpUtils
     */
    public function getHttpUtils()
    {
        return $this->httpUtils;
    }

    /**
     * @param HttpUtils $httpUtils
     * @return AuthorizeRedirectResponse
     */
    public function setHttpUtils($httpUtils)
    {
        $this->httpUtils = $httpUtils;

        return $this;
    }

    /**
     * @return RequestStack
     */
    public function getRequestStack()
    {
        return $this->requestStack;
    }

    /**
     * @param RequestStack $requestStack
     * @return AuthorizeRedirectResponse
     */
    public function setRequestStack($requestStack)
    {
        $this->requestStack = $requestStack;

        return $this;
    }

    /**
     * @return string
     */
    public function getCheckPath()
    {
        return $this->check_path;
    }

    /**
     * @param string $check_path
     * @return AuthorizeRedirectResponse
     */
    public function setCheckPath($check_path)
    {
        $this->check_path = $check_path;

        return $this;
    }

    public function getForwardedResponse()
    {
        $request = $this->getRequestStack()->getCurrentRequest();

        $subRequest = $this->httpUtils->createRequest(
          $request,
          $this->getLoginPath()
        );
        $subRequest->query->add(
          $request->query->getIterator()->getArrayCopy()
        );

        $response = $this->getKernel()->handle(
          $subRequest,
          HttpKernelInterface::SUB_REQUEST
        );
        if (200 === $response->getStatusCode()) {
            $response->headers->set('X-Status-Code', 401);
        }

        return $response;
    }

    /**
     * @return string
     */
    public function getLoginPath()
    {
        return $this->login_path;
    }

    /**
     * @param $login_path
     * @return $this
     */
    public function setLoginPath($login_path)
    {
        $this->login_path = $login_path;

        return $this;
    }

    /**
     * @return \Symfony\Component\HttpKernel\Kernel
     */
    public function getKernel()
    {
        return $this->kernel;
    }

    /**
     * @param $kernel
     * @return $this
     */
    public function setKernel($kernel)
    {
        $this->kernel = $kernel;

        return $this;
    }

}