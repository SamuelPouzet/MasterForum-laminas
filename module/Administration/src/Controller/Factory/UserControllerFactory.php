<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 25/07/2020
 * Time: 19:59
 */

namespace Administration\Controller\Factory;


use Administration\Controller\UserController;
use Administration\Service\UserManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class UserControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        $userManager = $container->get(UserManager::class);

        return new UserController($entityManager, $userManager);
    }

}