<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 29/07/2020
 * Time: 17:12
 */

namespace Application\Controller\Factory;


use Application\Controller\CssController;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class CssControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        return new CssController($entityManager);
    }

}