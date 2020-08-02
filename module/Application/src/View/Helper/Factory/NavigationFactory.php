<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 16/07/2020
 * Time: 07:40
 */

namespace Application\View\Helper\Factory;


use Application\Service\NavigationManager;
use Application\View\Helper\Navigation;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class NavigationFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $navigationManager = $container->get(NavigationManager::class);

        return new Navigation($navigationManager);
    }

}