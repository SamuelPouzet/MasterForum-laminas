<?php
namespace User\Service\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Session\SessionManager;
use User\Service\AuthenticationService;
use User\Service\AuthManager;
use User\Service\RbacManager;

/**
 * This is the factory class for AuthManager service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class AuthManagerFactory implements FactoryInterface
{
    /**
     * This method creates the AuthManager service and returns its instance. 
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        $config = $container->get('Config');
        if (isset($config['access_filter'])){
            $config = $config['access_filter'];
        }else{
            $config = [
                'mode'=>'restrictive',
                'config'=>[],
            ];
        }
        $authService = $container->get(AuthenticationService::class);

        $sessionManager = $container->get(SessionManager::class);

        $rbacManager = $container->get(RbacManager::class);

        return new AuthManager($config, $authService, $sessionManager, $rbacManager);
    }
}
