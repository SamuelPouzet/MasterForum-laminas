<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 07/08/2020
 * Time: 07:58
 */

namespace User\Service\Factory;


use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Service\LogManager;

class LogManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        return new LogManager($entityManager);
    }

}