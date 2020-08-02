<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/07/2020
 * Time: 11:26
 */

namespace Application\Service\Factory;


use Application\Service\ResponseManager;
use Application\Service\TextService;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class TextServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new TextService($entityManager);
    }

}