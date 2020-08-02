<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/07/2020
 * Time: 07:16
 */

namespace Administration\Controller;


use Administration\Controller\Base\BaseController;
use Administration\Service\ForumSubjectManager;
use Application\Entity\ForumSubject;
use Administration\Form\SubjectForm;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Module;

class SubjectController extends AbstractActionController
{

    protected $entityManager;

    protected $subjectManager;

    public function __construct(EntityManager $entityManager, ForumSubjectManager $subjectManager)
    {
        $this->entityManager = $entityManager;
        $this->subjectManager = $subjectManager;
    }

    public function indexAction():ViewModel
    {
        $categoryid= (int) $this->params()->fromRoute('id', 0);


        $subjects = $this->entityManager->getRepository(ForumSubject::class)->findSubjectsInForum($categoryid);


        return new ViewModel([
            'subjects'=>$subjects,
        ]);
    }

    public function newAction():ViewModel
    {
        $form = new SubjectForm($this->entityManager, 'Subject-form');

        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                $this->subjectManager->add($data);
                $this->redirect()->toRoute('admin/pages/subject', ['id_forum'=>\User\Module::getForumId()]);
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);

    }

    public function editAction():ViewModel
    {
        $id = (int) $this->params()->fromRoute('id', -1);

        $subject = $this->entityManager->getRepository(ForumSubject::class)->findSubjectInForum($id);

        if(!$subject){
            throw new \Exception('Subject not found');
        }

        $form = new SubjectForm($this->entityManager, 'Subject-form');

        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                $this->subjectManager->update($subject, $data);
                $this->redirect()->toRoute('admin/pages/subject', ['id_forum'=>\User\Module::getForumId()]);
            }
        }

        $form->bind($subject);

        return new ViewModel([
            'form' => $form,
        ]);

    }

}