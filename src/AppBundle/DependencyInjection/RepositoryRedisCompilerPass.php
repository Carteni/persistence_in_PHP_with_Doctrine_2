<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class RepositoryRedisCompilerPass
 * @package AppBundle\DependencyInjection
 */
class RepositoryRedisCompilerPass implements CompilerPassInterface {

  /**
   * You can modify the container here before it is dumped to PHP code.
   *
   * @param ContainerBuilder $container
   */
  public function process(ContainerBuilder $container) {

    $taggedServices = $container->findTaggedServiceIds('repository.redis.default');
    foreach($taggedServices as $id => $tags) {
     $container->getDefinition($id)->addMethodCall('setDefaultCache',
       array(new Reference('snc_redis.default')));
    }

    $container
      ->getDefinition('app.github.authentication_listener')
      ->addMethodCall('setKeys', array(
        $container->getParameter('github.oauth.client_id'),
        $container->getParameter('github.oauth.client_secret')
      ))
    ;
  }
}