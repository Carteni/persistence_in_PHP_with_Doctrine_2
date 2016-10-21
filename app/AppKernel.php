<?php

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
          new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
          new Symfony\Bundle\SecurityBundle\SecurityBundle(),
          new Symfony\Bundle\TwigBundle\TwigBundle(),
          new Symfony\Bundle\MonologBundle\MonologBundle(),
          new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
          new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
          new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
          new AppBundle\AppBundle(),
          new \FOS\UserBundle\FOSUserBundle(),
          new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),

          new Snc\RedisBundle\SncRedisBundle(),

          new FOS\HttpCacheBundle\FOSHttpCacheBundle(),

          new \Ivory\GoogleMapBundle\IvoryGoogleMapBundle(),

          new Cocur\Slugify\Bridge\Symfony\CocurSlugifyBundle(),

            # Sonata Core
          new Sonata\CoreBundle\SonataCoreBundle(),
          new Knp\Bundle\MenuBundle\KnpMenuBundle(),
          new Sonata\BlockBundle\SonataBlockBundle(),

          new Sonata\MediaBundle\SonataMediaBundle(),
          new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
          new Sonata\IntlBundle\SonataIntlBundle(),
            // You need to add this dependency to make media functional
          new JMS\SerializerBundle\JMSSerializerBundle(),

          new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),

          new \Sonata\ClassificationBundle\SonataClassificationBundle(),
          new Application\Sonata\ClassificationBundle\ApplicationSonataClassificationBundle(
          ),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle(
            );
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle(
            );
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle(
            );
            $bundles[] = new \Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(
            );
        }

        return $bundles;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(
          $this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml'
        );
    }

    public function getRootDir()
    {
        return __DIR__;
    }
}
