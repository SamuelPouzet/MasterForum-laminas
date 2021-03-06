<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 16/07/2020
 * Time: 19:34
 */

namespace Application\Service\Factory;


use Application\Service\ProfileManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ProfileManagerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new ProfileManager($entityManager);
    }

}