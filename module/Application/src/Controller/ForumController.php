<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 10/07/2020
 * Time: 20:29
 */

namespace Application\Controller;


use Application\Controller\Base\BaseController;
use Application\Entity\Forum;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Entity\Log;
use User\Module;

class ForumController extends AbstractActionController
{

    protected $entityManager;

    protected $forum;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {

        $forumId = Module::getForumId();

        $this->forum = $this->entityManager->getRepository(Forum::class)->find($forumId);

        if(!$this->forum){
            $this->getResponse()->setStatusCode(404);
        }

        $connected = $this->entityManager->getRepository(Log::class)->getConnectedUsers();


        return new ViewModel([
            'forum' => $this->forum,
            'connected_users' => $connected,
        ]);
    }




}