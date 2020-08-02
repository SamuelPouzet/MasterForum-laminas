<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/12/2019
 * Time: 19:21
 */

namespace Css\Controller\Factory;

use Css\Controller\AdminController;
use Css\Service\CssManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;


class AdminControllerFactory implements  FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $cssManager = $container->get(CssManager::class);

        return new AdminController($entityManager, $cssManager);
    }


}