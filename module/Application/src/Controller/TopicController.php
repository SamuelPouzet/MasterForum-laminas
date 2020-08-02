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
use Application\Form\TopicForm;
use Doctrine\ORM\EntityManager;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Paginator\Paginator;
use Laminas\View\Model\ViewModel;

class TopicController extends AbstractActionController
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * TopicController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
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

        $form = new TopicForm($this->entityManager, $subject);

        return new ViewModel([
            'form'=>$form,
        ]);
    }

}