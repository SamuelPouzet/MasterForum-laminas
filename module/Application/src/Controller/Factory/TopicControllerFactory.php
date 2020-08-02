<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 10/07/2020
 * Time: 20:32
 */

namespace Application\Controller\Factory;

use Application\Controller\TopicController;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class TopicControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new TopicController($entityManager);
    }

}