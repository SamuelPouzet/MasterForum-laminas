<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/07/2020
 * Time: 10:26
 */

namespace Application\Controller;


use Application\Controller\Base\BaseController;
use Application\Entity\ForumResponse;
use Application\Entity\ForumSubject;
use Application\Entity\ForumTopic;
use Application\Entity\Template\CustomResponse;
use Application\Form\TopicForm;
use Application\Service\TopicManager;
use Doctrine\ORM\EntityManager;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Paginator\Paginator;
use Laminas\View\Model\ViewModel;
use User\Entity\User;
use User\Module;

class TopicController extends AbstractActionController
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    protected $topicManager;

    /**
     * TopicController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, TopicManager $topicManager)
    {
        $this->entityManager = $entityManager;
        $this->topicManager = $topicManager;
    }

    public function viewAction():ViewModel
    {
        $idTopic = (int) $this->params()->fromRoute('id', -1);
        $page = (int) $this->params()->fromRoute('numpage', 1);

        $topic = $this->entityManager->getRepository(ForumTopic::class)->findTopicInForum(
            $idTopic
        );

        $query = $this->entityManager->getRepository(ForumResponse::class)->getQueryForPagination($topic);

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(6);
        $paginator->setCurrentPageNumber($page);

        if(!$topic){
            $this->getResponse()->setStatusCode(404);
        }

        return new ViewModel([
            "topic"=>$topic,
            'responses'=>$paginator
        ]);
    }

    public function addAction():ViewModel
    {
        $idSubject = (int) $this->params()->fromRoute('id', -1);

        $subject = $this->entityManager->getRepository(ForumSubject::class)->findSubjectInForum(
            $idSubject
        );

        if (!$subject){
            throw new \Exception('this subject does not exist');
        }

        $customTemplate = $this->entityManager->getRepository(CustomResponse::class)->find( $subject->getType() );
        $form = new TopicForm($customTemplate);

        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            //@todo refacto in a fom collection
            $custom = isset($data['custom'])?json_encode($data['custom']):null;
            $normal = isset($data['normal_post'])?$data['normal_post']:null;
            $form->setData($data);
            if($form->isValid()){
                $author = $this->currentUser();
                $data = $form->getData();
                $data['custom'] = $custom;
                $data['normal'] = $normal;
                $this->topicManager->add($data, $subject, $author);
                $this->redirect()->toRoute('forum/response', ['action'=>'view', 'id_forum'=>Module::getForumId(),'id'=>$idSubject]);
            }
        }

        return new ViewModel([
            'form' => $form,
            'template' => $customTemplate,
        ]);
    }

}