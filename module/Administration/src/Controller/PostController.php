<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/07/2020
 * Time: 13:44
 */

namespace Administration\Controller;


use Administration\Controller\Base\BaseController;
use Administration\Form\ResponseForm;
use Administration\Form\TopicForm;
use Administration\Service\ForumResponseManager;
use Administration\Service\ForumTopicManager;
use Application\Entity\ForumResponse;
use Application\Entity\ForumTopic;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class PostController extends AbstractActionController
{

    protected $entityManager;

    protected $postManager;

    public function __construct(EntityManager $entityManager, ForumResponseManager $postManager)
    {
        $this->entityManager = $entityManager;
        $this->postManager = $postManager;
    }

    public function indexAction():ViewModel
    {
        $posts = $this->entityManager->getRepository(ForumResponse::class)->searchResponsesInForum();

        return new ViewModel([
            'posts' => $posts,
        ]);
    }

    public function newAction():ViewModel
    {
        $form = new ResponseForm($this->entityManager, 'Post-form');

        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                $this->postManager->add($data);
                $this->redirect()->toRoute('admin/pages/topic', ['id_forum'=>\User\Module::getForumId()]);
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);

    }

    public function editAction():ViewModel
    {
        $id = (int) $this->params()->fromRoute('id', -1);

        $topic = $this->entityManager->getRepository(ForumResponse::class)->searchResponseInForum($id);

        if(!$topic){
            throw new \Exception('Post not found');
        }

        $form = new ResponseForm($this->entityManager, 'Post-form');

        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                $this->postManager->update($topic, $data);
                $this->redirect()->toRoute('admin/pages/topic', ['id_forum'=>\User\Module::getForumId()]);
            }
        }

        $form->bind($topic);

        return new ViewModel([
            'form' => $form,
        ]);

    }

}