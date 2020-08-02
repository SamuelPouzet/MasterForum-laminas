<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 10/07/2020
 * Time: 20:32
 */

namespace Application\Controller\Factory;

use Application\Controller\ResponseController;
use Application\Service\ResponseManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ResponseControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $responseManager = $container->get(ResponseManager::class);

        return new ResponseController($entityManager, $responseManager);
    }

}