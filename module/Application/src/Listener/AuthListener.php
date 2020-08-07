<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 07/08/2020
 * Time: 07:04
 */

namespace Application\Listener;


use Laminas\EventManager\AbstractListenerAggregate;
use Laminas\EventManager\EventManagerInterface;
use Laminas\Mvc\MvcEvent;
use User\Controller\AuthController;
use User\Service\AuthManager;

class AuthListener extends AbstractListenerAggregate
{

    protected $event;

    public function __construct(MvcEvent $event)
    {
        $this->event = $event;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH,
            [$this, 'checkAuthorization']
        );
    }

    public function checkAuthorization()
    {

        $routeMatch = $this->event->getRouteMatch();

        $controller = $this->event->getTarget();

        $controllerName = $routeMatch->getParam('controller', null);

        $actionName = $routeMatch->getParam('action', null);


        $actionName = str_replace('-', '', lcfirst(ucwords($actionName, '-')));

        $authManager = $this->event->getApplication()->getServiceManager()->get(AuthManager::class);

        if ($controllerName!=AuthController::class) {
            $result = $authManager->filterAccess($controllerName, $actionName);

            if ($result == AuthManager::AUTH_REQUIRED) {

                // Remember the URL of the page the user tried to access. We will
                // redirect the user to that URL after successful login.
                $uri = $this->event->getApplication()->getRequest()->getUri();
                // Make the URL relative (remove scheme, user info, host name and port)
                // to avoid redirecting to other domain by a malicious user.
                $uri->setScheme(null)
                    ->setHost(null)
                    ->setPort(null)
                    ->setUserInfo(null);
                $redirectUrl = $uri->toString();

                // Redirect the user to the "Login" page.
                return $controller->redirect()->toRoute($this->getRoute($routeMatch), ['id_forum' => self::getForumId()],
                    ['query' => ['redirectUrl' => $redirectUrl]]);
            } else if ($result == AuthManager::ACCESS_DENIED) {

                // Redirect the user to the "Not Authorized" page.
                return $controller->redirect()->toRoute('not-authorized');
            }
        }
    }

}