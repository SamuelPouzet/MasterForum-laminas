<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 26/07/2020
 * Time: 17:42
 */

namespace Administration\Controller;


use Administration\Controller\Base\BaseController;
use Application\Entity\Forum;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Module;

class CategoryController extends AbstractActionController
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction():ViewModel
    {
        $forumId = Module::getForumId();

        $forum = $this->entityManager->getRepository(Forum::class)->find($forumId);

        if(!$forum){
            $this->getResponse()->setStatusCode(404);
        }

        return new ViewModel([
            'forum'=>$forum,
        ]);
    }

}