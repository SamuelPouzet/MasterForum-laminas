<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 16/07/2020
 * Time: 20:21
 */

namespace Application\Controller\Factory;


use Application\Controller\AccountController;
use Application\Service\AccountManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AccountControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $accountManager = $container->get(AccountManager::class);

        return new AccountController($entityManager, $accountManager);
    }

}