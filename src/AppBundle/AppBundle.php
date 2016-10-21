<?php

namespace AppBundle;

use AppBundle\DependencyInjection\OAuthGitHubCompilerPass;
use AppBundle\DependencyInjection\RepositoryRedisCompilerPass;
use AppBundle\Security\GitHub\SecurityFactory\SecurityFactory;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 *
 * https://gist.github.com/romansklenar/525030/38a0dd6a70e58f39e964ec53c746457dd37a5f58
 * http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/types.html#custom-mapping-types
 * http://stackoverflow.com/questions/4837589/doctrine-custom-data-type
 *
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
