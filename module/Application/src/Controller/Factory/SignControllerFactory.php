<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 18/07/2020
 * Time: 07:52
 */

namespace Application\Controller\Factory;


use Application\Controller\SignController;
use Application\Service\SignManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class SignControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $signManager = $container->get(SignManager::class);
        return new SignController($entityManager, $signManager);
    }

}