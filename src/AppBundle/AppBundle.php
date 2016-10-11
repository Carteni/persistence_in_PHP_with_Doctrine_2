<?php

namespace AppBundle;

use AppBundle\DependencyInjection\OAuthGitHubCompilerPass;
use AppBundle\DependencyInjection\RepositoryRedisCompilerPass;
use AppBundle\Security\GitHub\SecurityFactory\SecurityFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class AppBundle
 * @package AppBundle
 */
class AppBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new SecurityFactory());

        $container->addCompilerPass(new RepositoryRedisCompilerPass());
        $container->addCompilerPass(new OAuthGitHubCompilerPass());
    }
}
