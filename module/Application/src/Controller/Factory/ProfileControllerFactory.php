<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 16/07/2020
 * Time: 18:19
 */

namespace Application\Controller\Factory;


use Application\Controller\ProfileController;
use Application\Service\ProfileManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ProfileControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $profileManager = $container->get(ProfileManager::class);

        return new ProfileController($entityManager, $profileManager);
    }

}