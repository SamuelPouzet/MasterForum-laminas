<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 06/08/2020
 * Time: 19:50
 */

namespace User\Listener;


use Laminas\EventManager\AbstractListenerAggregate;
use Laminas\EventManager\EventManagerInterface;
use Laminas\Mvc\MvcEvent;
use User\Entity\User;
use User\Module;
use User\Service\AuthenticationService;
use User\Service\LogManager;

class LogListener extends AbstractListenerAggregate
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
            [$this, 'setLog']
        );
    }

    public function setLog() : void
    {
        $authManager = $this->event->getApplication()->getServiceManager()->get(AuthenticationService::class);
        if($authManager->hasIdentity()) {
            $logManager = $this->event->getApplication()->getServiceManager()->get(LogManager::class);
            $entityManager = $this->event->getApplication()->getServiceManager()->get('doctrine.entitymanager.orm_default');

            $user = $entityManager->getRepository(User::class)->findOneBy([
                'email' => $authManager->getIdentity(),
                'forum_id' => Module::getForumId(),
            ]);

            if(!$user){
                //security break
                throw new \Exception('User not found');
            }

            $logManager->log( $user );
        }
    }

}