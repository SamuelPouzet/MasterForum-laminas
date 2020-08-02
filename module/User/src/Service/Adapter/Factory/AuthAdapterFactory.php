<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 14/07/2020
 * Time: 12:46
 */

namespace User\Service\Adapter\Factory;


use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Service\Adapter\AuthAdapter;

class AuthAdapterFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new AuthAdapter($entityManager);
    }

}