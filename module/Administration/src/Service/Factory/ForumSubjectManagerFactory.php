<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 26/07/2020
 * Time: 12:36
 */

namespace Administration\Service\Factory;


use Administration\Service\ForumSubjectManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ForumSubjectManagerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        return new ForumSubjectManager($entityManager);
    }

}