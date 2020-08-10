<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 13/07/2020
 * Time: 19:32
 */

namespace User\Service;


use Laminas\Authentication\Result;
use Laminas\Session\SessionManager;


class AuthManager
{

    // Constants returned by the access filter.
    const ACCESS_GRANTED = 1; // Access to the page is granted.
    const AUTH_REQUIRED  = 2; // Authentication is required to see the page.
    const ACCESS_DENIED  = 3; // Access to the page is denied.

    protected $config;

    protected $mode;

    protected $entityManager;

    protected $authenticationService;

    protected $authAdapter;

    protected $sessionManager;

    protected $rbacManager;

    public function __construct(array $config, AuthenticationService $authenticationService, SessionManager $sessionManager, RbacManager $rbacManager)
    {

        if(!isset($config['mode'])){
            $config['mode'] = 'restrictive';
        }elseif(!in_array($config['mode'], ['permissive', 'restrictive'])){
            throw new \Exception('Config instruction is wrong');
        }
        $this->mode = $config['mode'];
        $this->config = $config['controllers'];

        $this->authenticationService = $authenticationService;
        $this->sessionManager = $sessionManager;
        $this->rbacManager = $rbacManager;
    }

    public function validate(array $data):Result
    {

        if ($this->authenticationService->getIdentity()!=null) {
            throw new \Exception('Already logged in');
        }
        $authAdapter = $this->authenticationService->getAdapter();
        $authAdapter->setEmail($data['email']);
        $authAdapter->setPassword($data['password']);
        $result = $this->authenticationService->authenticate();

        return $result;

    }


    public function filterAccess(string $controllerName, string $actionName):int
    {

        if(!isset($this->config[$controllerName])){
            if($this->mode == 'restrictive'){
                //no interdiction found, access is denied
                return self::ACCESS_DENIED;
            }else{
                //no interdiction found, access is granted
                return self::ACCESS_GRANTED;
            }
        }else{
            $configs = $this->config[$controllerName];

            foreach($configs as $config){
                if(in_array($actionName, $config['actions'])){
                    if($config['allow'] == '*'){
                        return self::ACCESS_GRANTED;
                    }else{
                        return $this->checkAuthorization($config['allow']);
                    }
                    break;
                }
            }

            if($this->mode == 'restrictive'){
                //no interdiction found, access is denied
                return self::ACCESS_DENIED;
            }else{
                //no interdiction found, access is granted
                return self::ACCESS_GRANTED;
            }
        }
    }

    private function  checkAuthorization(string $allow):int
    {

        switch($allow[0]) {
            case "*":
                return self::ACCESS_GRANTED;
                break;
            case "@":
                if ($this->authenticationService->hasIdentity()){
                    return self::ACCESS_GRANTED;
                }else{
                    return self::AUTH_REQUIRED;
                }
                break;
            case "+":
                if( $this->rbacManager->isGranted( ltrim($allow,
                    "+") ) ){
                    return self::ACCESS_GRANTED;
                }else{
                    return self::ACCESS_DENIED;
                }
                break;
            case "#":
                //@todo: gestion des personnes
                break;
            case "!":
                //@todo: gestion des admins
                break;
            default:
                return false;

        }

    }

    public function logout()
    {

        if($this->authenticationService->hasIdentity()){
            $this->authenticationService->clearIdentity();
            return true;
        }

        throw new \Exception('no user logged in this forum');
    }


}