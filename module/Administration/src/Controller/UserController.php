<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 26/07/2020
 * Time: 09:12
 */

namespace Administration\Controller;


use Administration\Controller\Base\BaseController;
use Administration\Form\PasswordChangeForm;
use Administration\Form\UserForm;
use Administration\Service\UserManager;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Entity\User;
use User\Module;

class UserController extends AbstractActionController
{

    protected $entityManager;

    protected $userManager;

    public function __construct(EntityManager $entityManager, UserManager $userManager)
    {
        $this->entityManager = $entityManager;
        $this->userManager = $userManager;
    }

    public function indexAction():ViewModel
    {
        $users = $this->entityManager->getRepository(User::class)->findBy(
            [
                'forum_id'=>Module::getForumId(),
            ],
        );

        return new ViewModel([
            'users'=>$users,
        ]);
    }

    public function newAction():ViewModel
    {


        $form = new UserForm();

        if($this->getRequest()->isPost()){
            $data=$this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                $this->userManager->add($data);
                $this->redirect()->toRoute('admin/user', ['action'=>'index', 'id_forum'=>Module::getForumId()]);

            }
        }

        return new ViewModel([
            'form'=>$form,
        ]);
    }

    public function editAction():ViewModel
    {
        $id_user = (int) $this->params()->fromRoute('id', 0);

        //add security, control if user given in param is in this forum, to avoid url modifications
        $user = $this->entityManager->getRepository(User::class)->findOneBy([
            'id' => $id_user,
            'forum_id'=>$this->forum->getId(),
        ]);

        if(!$user){
            throw new \Exception('user not found');
        }

        $form = new UserForm();

        if($this->getRequest()->isPost()){
            $data=$this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                $this->userManager->update($user, $data);
                $this->redirect()->toRoute('admin/user', ['action'=>'index', 'id_forum'=>Module::getForumId()]);

            }
        }

        $form->bind($user);

        return new ViewModel([
            'user'=>$user,
            'form'=>$form,
        ]);
    }

    public function passwordAction():ViewModel
    {
        $id_user = (int) $this->params()->fromRoute('id', 0);

        //add security, control if user given in param is in this forum, to avoid url modifications
        $user = $this->entityManager->getRepository(User::class)->findOneBy([
            'id' => $id_user,
            'forum_id'=>$this->forum->getId(),
        ]);

        if(!$user){
            throw new \Exception('user not found');
        }

        $form = new PasswordChangeForm();

        if($this->getRequest()->isPost()){
            $data=$this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                $this->userManager->update($user, $data);
                $this->redirect()->toRoute('admin/user', ['action'=>'index', 'id_forum'=>Module::getForumId()]);

            }
        }

        $form->bind($user);

        return new ViewModel([
            'user'=>$user,
            'form'=>$form,
        ]);
    }

}