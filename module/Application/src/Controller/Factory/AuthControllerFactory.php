<?php
namespace Application\Controller\Factory;


use Interop\Container\ContainerInterface;
use Application\Controller\AuthController;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * This is the factory for AuthController. Its purpose is to instantiate the controller
 * and inject dependencies into its constructor.
 */
class AuthControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new AuthController($entityManager);
    }
}
