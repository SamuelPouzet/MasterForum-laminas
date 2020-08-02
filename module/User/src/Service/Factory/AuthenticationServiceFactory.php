<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 14/07/2020
 * Time: 11:43
 */

namespace User\Service\Factory;


use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Session\SessionManager;
use Laminas\Authentication\Storage\Session as SessionStorage;
use User\Module;
use User\Service\Adapter\AuthAdapter;
use User\Service\AuthenticationService;

//use User\Service\AuthenticationService;

class AuthenticationServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $storageName = "SamForum" . Module::getForumId() . "Session";

        $sessionManager = $container->get(SessionManager::class);
        $authStorage = new SessionStorage($storageName, 'session', $sessionManager);

        $adapter = $container->get(AuthAdapter::class);

        return new AuthenticationService($authStorage, $adapter);
    }

}