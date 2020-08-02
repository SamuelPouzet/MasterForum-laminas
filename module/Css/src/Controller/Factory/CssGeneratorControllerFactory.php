<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 28/12/2019
 * Time: 12:35
 */

namespace Css\Controller\Factory;



use Css\Controller\CssGeneratorController;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class CssGeneratorControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new CssGeneratorController($entityManager);
    }

}