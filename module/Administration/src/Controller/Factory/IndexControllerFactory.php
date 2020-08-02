<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 25/07/2020
 * Time: 19:59
 */

namespace Administration\Controller\Factory;


use Administration\Controller\IndexController;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class IndexControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        return new IndexController($entityManager);
    }

}