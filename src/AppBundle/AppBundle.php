<?php

namespace AppBundle;

use AppBundle\DependencyInjection\RepositoryRedisCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class AppBundle
 * @package AppBundle
 */
class AppBundle extends Bundle {
  public function build(ContainerBuilder $container) {
    parent::build($container);
    $container->addCompilerPass(new RepositoryRedisCompilerPass());
  }
}
