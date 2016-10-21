<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Class Builder
 * @package AppBundle\Menu
 */
class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function dashboardMenu(FactoryInterface $factory, array $options)
    {
        $nav = $this->container->getParameter('admin_navigation')['modules'];

        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(array('class'=>'metismenu nav','id'=>'sidemenu'));

        foreach ($nav as $module_name => $module) {
            $menu->addChild($module['label']);

            /**
             * @var ItemInterface $node
             */
            $node = $menu[$module['label']];
            $node->setAttribute('icon', $module['icon']);
            $node->setExtra('actions',count($module['actions']));
            $node->setExtra('children',count($module['children']));

            if (count($module['actions'])) {
                foreach ($module['actions'] as $action) {
                    $node
                      ->addChild(
                        $action['label'],
                        array(
                          'route' => $action['route'],
                        )
                      )
                      ->setAttribute('icon', $action['icon']);
                }
            }

            if (count($module['children'])) {
                foreach ($module['children'] as $children) {
                    $node->addChild($children['label']);

                    /**
                     * @var ItemInterface $node
                     */
                    $childNode = $node[$children['label']];
                    $childNode->setAttribute('icon', $children['icon']);
                    $childNode->setExtra('actions',count($children['actions']));
                    $childNode->setExtra('parent',$module_name);

                    if (count($children['actions'])) {
                        foreach ($children['actions'] as $action) {
                            $childNode
                              ->addChild(
                                $action['label'],
                                array(
                                  'route' => $action['route'],
                                )
                              )
                              ->setAttribute('icon', $action['icon']);
                        }
                    }
                }
            }
        }

        return $menu;
    }
}