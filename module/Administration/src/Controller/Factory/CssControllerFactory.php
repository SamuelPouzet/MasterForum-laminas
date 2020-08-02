<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 25/07/2020
 * Time: 19:59
 */

namespace Administration\Controller\Factory;


use Administration\Controller\CssController;
use Css\Service\CssManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class CssControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $cssManager = $container->get(CssManager::class);
        return new CssController($entityManager, $cssManager);
    }

}