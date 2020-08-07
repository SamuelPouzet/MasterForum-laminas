<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 02/08/2020
 * Time: 20:36
 */

namespace Application\Service\Factory;


use Application\Service\TopicManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class TopicManagerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new TopicManager($entityManager);

    }

}