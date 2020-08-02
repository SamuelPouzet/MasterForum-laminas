<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 20/07/2020
 * Time: 13:21
 */

namespace Application\Controller\Factory;


use Application\Controller\MessengerController;
use Application\Service\Messenger\ResponseManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class MessengerControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $responseManager = $container->get(ResponseManager::class);

        return new MessengerController($entityManager, $responseManager);
    }

}