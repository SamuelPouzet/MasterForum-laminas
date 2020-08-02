<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 25/07/2020
 * Time: 19:59
 */

namespace Administration\Controller\Factory;


use Administration\Controller\SubjectController;
use Administration\Service\ForumSubjectManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class SubjectControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        $subjectManager = $container->get(ForumSubjectManager::class);

        return new SubjectController($entityManager, $subjectManager);
    }

}