<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 16/07/2020
 * Time: 07:54
 */

namespace Application\Service\Factory;


use Application\Service\NavigationManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Service\AuthenticationService;

class NavigationManagerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $viewHelperManager = $container->get('ViewHelperManager');
        $urlHelper = $viewHelperManager->get('url');
        $authenticationManager = $container->get(AuthenticationService::class);

        return new NavigationManager($entityManager, $urlHelper, $authenticationManager);
    }

}