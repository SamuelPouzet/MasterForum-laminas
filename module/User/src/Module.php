<?php
namespace User;

use Application\Listener\AuthListener;
use Laminas\Mvc\MvcEvent;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Session\SessionManager;
use User\Listener\LogListener;

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

        $authListener = new AuthListener( $event );
        $authListener->attach( $eventManager );

        $logListener = new LogListener( $event );
        $logListener->attach( $eventManager );

        $sharedEventManager = $eventManager->getSharedManager();
        // Register the event listener method.

        $sharedEventManager->attach(AbstractActionController::class,
                MvcEvent::EVENT_DISPATCH, [$this, 'setForumId'], 100);

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
    public static function setForumId(MvcEvent $event)
    {

        $routeMatch = $event->getRouteMatch();
        self::$forumId = (int)$routeMatch->getParam('id_forum', 0);
    }

    public static function getForumId()
    {
        return self::$forumId;
    }

}
