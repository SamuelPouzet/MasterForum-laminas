<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 18/07/2020
 * Time: 08:12
 */

namespace Application\Service\Factory;


use Application\Service\MailerService;
use Application\Service\SignManager;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use User\Service\AuthenticationService;

class SignManagerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $authenticationService = $container->get(AuthenticationService::class);
        $mailerService = $container->get(MailerService::class);

        return new SignManager($entityManager, $authenticationService, $mailerService);
    }

}