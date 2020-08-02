<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/07/2020
 * Time: 13:44
 */

namespace Administration\Controller;


use Administration\Controller\Base\BaseController;
use Administration\Form\TopicForm;
use Administration\Service\ForumTopicManager;
use Application\Entity\ForumTopic;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class TopicController extends AbstractActionController
{

    protected $entityManager;

    protected $topicManager;

    public function __construct(EntityManager $entityManager, ForumTopicManager $topicManager)
    {
        $this->entityManager = $entityManager;
        $this->topicManager = $topicManager;
    }

    public function indexAction():ViewModel
    {
        $topics = $this->entityManager->getRepository(ForumTopic::class)->findTopicsInForum();

        return new ViewModel([
            'topics' => $topics,
        ]);
    }

    public function newAction():ViewModel
    {
        $form = new TopicForm('Subject-form', ['forum'=>$this->forum]);

        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                $this->topicManager->add($data);
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

        $topic = $this->entityManager->getRepository(ForumTopic::class)->findTopicInForum($id);

        if(!$topic){
            throw new \Exception('Subject not found');
        }

        $form = new TopicForm('Subject-form', ['forum'=>$this->forum]);

        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                $this->topicManager->update($topic, $data);
                $this->redirect()->toRoute('admin/pages/topic', ['id_forum'=>\User\Module::getForumId()]);
            }
        }

        $form->bind($topic);

        return new ViewModel([
            'form' => $form,
        ]);

    }

}