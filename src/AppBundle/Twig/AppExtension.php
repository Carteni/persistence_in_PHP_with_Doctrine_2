<?php
namespace AppBundle\Twig;

use AppBundle\Utils\DateUtils;

class AppExtension extends \Twig_Extension implements \Twig_Extension_InitRuntimeInterface
{
    /**
     * @var \Twig_Environment
     */
    protected $environment;

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getFilters()
    {
        return [
          new \Twig_SimpleFilter('dateDiff', [$this, 'dateDiff']),
        ];
    }

    public function dateDiff(\DateTime $date)
    {
        return DateUtils::timeAgo($date);
    }

}