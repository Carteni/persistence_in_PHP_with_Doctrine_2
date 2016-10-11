<?php

namespace AppBundle\Security\GitHub\SecurityFactory;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\AbstractFactory;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class SecurityFactory
 * @package AppBundle\Security\GitHub\SecurityFactory
 */
class SecurityFactory extends AbstractFactory
{
    /**
     * {@inheritDoc}
     */
    public function addConfiguration(NodeDefinition $node)
    {
        parent::addConfiguration($node);

        $builder = $node->children();
        $builder
          ->scalarNode('login_path')->cannotBeEmpty()->isRequired()->end()
        ;
    }

    public function create(ContainerBuilder $container, $id, $config, $userProviderId, $defaultEntryPointId)
    {
        $container->setParameter('github.oauth.authorize_path', $config['login_path']);
        $container->setParameter('github.oauth.redirect_path', $config['check_path']);

        return parent::create($container, $id, $config, $userProviderId, $defaultEntryPointId);
    }

    /**
     * Defines the position at which the provider is called.
     * Possible values: pre_auth, form, http, and remember_me.
     *
     * @return string
     */
    public function getPosition()
    {
        return 'pre_auth';
    }

    /**
     * Defines the configuration key used to reference the provider
     * in the firewall configuration.
     *
     * @return string
     */
    public function getKey()
    {
        return 'github';
    }

    /**
     * Subclasses must return the id of a service which implements the
     * AuthenticationProviderInterface.
     *
     * @param ContainerBuilder $container
     * @param string $id The unique id of the firewall
     * @param array $config The options array for this listener
     * @param string $userProviderId The id of the user provider
     *
     * @return string never null, the id of the authentication provider
     */
    protected function createAuthProvider(
      ContainerBuilder $container,
      $id,
      $config,
      $userProviderId
    ) {

        $providerId = 'app.github.authentication_provider.'.$id;
        $definition = $container->setDefinition(
          $providerId,
          new DefinitionDecorator(
            'app.github.authentication_provider'
          )
        );

        if (isset($config['provider'])) {
            $definition->addArgument(new Reference($userProviderId));
        }

        return $providerId;
    }

    /**
     * {@inheritDoc}
     */
    protected function createEntryPoint(
      $container,
      $id,
      $config,
      $defaultEntryPoint
    ) {

        $entryPointId = 'app.github.authentication.entry_point.oauth.'.$id;

        $container
          ->setDefinition(
            $entryPointId,
            new DefinitionDecorator(
              'app.github.authentication.entry_point.oauth'
            )
          )
          ->addArgument($config['use_forward']);

        return $entryPointId;
    }

    /**
     * Subclasses must return the id of the listener template.
     *
     * Listener definitions should inherit from the AbstractAuthenticationListener
     * like this:
     *
     *    <service id="my.listener.id"
     *             class="My\Concrete\Classname"
     *             parent="security.authentication.listener.abstract"
     *             abstract="true" />
     *
     * In the above case, this method would return "my.listener.id".
     *
     * @return string
     */
    protected function getListenerId()
    {
        return 'app.github.authentication_listener';
    }
}