<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 02/08/2020
 * Time: 10:39
 */

namespace User\Controller\Plugin\Factory;


use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Controller\Plugin\DelogPlugin;
use User\Service\AuthManager;

class DelogPluginFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $authManager = $container->get(AuthManager::class);

        return new DelogPlugin($entityManager, $authManager);
    }

}