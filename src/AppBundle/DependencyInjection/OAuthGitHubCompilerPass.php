<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class OAuthGitHubCompilerPass
 * @package AppBundle\DependencyInjection
 */
class OAuthGitHubCompilerPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $container
          ->getDefinition('app.github.authentication_listener')
          ->addMethodCall(
            'setKeys',
            array(
              $container->getParameter('github.oauth.client_id'),
              $container->getParameter('github.oauth.client_secret'),
            )
          );

        $container
          ->getDefinition('app.github.authorize.redirect_response')
          ->addArgument($container->getParameter('github.oauth.client_id'))
          ->addArgument($container->getParameter('github.oauth.authorize_path'))
          ->addArgument($container->getParameter('github.oauth.redirect_path'));
    }
}