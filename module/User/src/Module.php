<?php
namespace User;

use Laminas\Mvc\MvcEvent;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Router\Http\RouteMatch;
use Laminas\Session\Container;
use Laminas\Session\SessionManager;
use User\Controller\AuthController;
use User\Service\AuthManager;

class Module
{

    protected $sessionManager = null;

    protected static $forumId;

    /**
     * This method returns the path to module.config.php file.
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    /**
     * This method is called once the MVC bootstrapping is complete and allows
     * to register event listeners. 
     */
    public function onBootstrap(MvcEvent $event)
    {

        // Get event manager.
        $eventManager = $event->getApplication()->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
        // Register the event listener method.

        $sharedEventManager->attach(AbstractActionController::class, 
                MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch'], 100);

        $this->sessionManager = $event->getApplication()->getServiceManager()->get(SessionManager::class);

        $this->forgetInvalidSession();
    }
    
    protected function forgetInvalidSession()
    {
    	try {
    		$this->sessionManager->start();
    		return;
    	} catch (\Exception $e) {
    	}
    	/**
    	 * Session validation failed: toast it and carry on.
    	 */
    	// @codeCoverageIgnoreStart
    	session_unset();
    	// @codeCoverageIgnoreEnd
    }
    
    /**
     * Event listener method for the 'Dispatch' event. We listen to the Dispatch
     * event to call the access filter. The access filter allows to determine if
     * the current visitor is allowed to see the page or not. If he/she
     * is not authorized and is not allowed to see the page, we redirect the user 
     * to the login page.
     */
    public function onDispatch(MvcEvent $event)
    {
        $routeMatch = $event->getRouteMatch();

        self::$forumId = (int)$routeMatch->getParam('id_forum', 0);
        // Get controller and action to which the HTTP request was dispatched.
        $controller = $event->getTarget();

        $controllerName = $routeMatch->getParam('controller', null);

        $actionName = $routeMatch->getParam('action', null);


        // Convert dash-style action name to camel-case.
        $actionName = str_replace('-', '', lcfirst(ucwords($actionName, '-')));
        
        // Get the instance of AuthManager service.
        $authManager = $event->getApplication()->getServiceManager()->get(AuthManager::class);

        // Execute the access filter on every controller except AuthController
        // (to avoid infinite redirect).
        if ($controllerName!=AuthController::class)
        {
            $result = $authManager->filterAccess($controllerName, $actionName);

            if ($result==AuthManager::AUTH_REQUIRED) {
                // Remember the URL of the page the user tried to access. We will
                // redirect the user to that URL after successful login.
                $uri = $event->getApplication()->getRequest()->getUri();
                // Make the URL relative (remove scheme, user info, host name and port)
                // to avoid redirecting to other domain by a malicious user.
                $uri->setScheme(null)
                    ->setHost(null)
                    ->setPort(null)
                    ->setUserInfo(null);
                $redirectUrl = $uri->toString();

                // Redirect the user to the "Login" page.
                return $controller->redirect()->toRoute( $this->getRoute($routeMatch), ['id_forum'=>self::getForumId()],
                        ['query'=>['redirectUrl'=>$redirectUrl]]);
            }
            else if ($result==AuthManager::ACCESS_DENIED) {

                // Redirect the user to the "Not Authorized" page.
                return $controller->redirect()->toRoute('not-authorized');

            }
        }
    }

    public static function getForumId()
    {
        return self::$forumId;
    }

    private function getRoute(RouteMatch $routeMatch)
    {
        $queriedModule = explode('/', $routeMatch->getMatchedRouteName())[0];
        switch($queriedModule){
            case "forum":
                return 'forum/forum_login';
                break;
            default:
                throw new \Exception('no auth to this module');

        }
    }
}
