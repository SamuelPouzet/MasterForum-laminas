<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 18/07/2020
 * Time: 07:51
 */

namespace Application\Controller;

use Application\Form\PasswordChangeForm;
use Application\Form\PasswordResetForm;
use Application\Form\SignForm;
use Application\Service\SignManager;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Entity\User;
use User\Module;

class SignController extends AbstractActionController
{

    protected $entityManager;

    protected $signManager;

    public function __construct(EntityManager $entityManager, SignManager $signManager)
    {
        $this->entityManager = $entityManager;
        $this->signManager = $signManager;
    }

    public function indexAction():ViewModel
    {

        $form = new SignForm();

        $user = $this->currentUser();

        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                $this->signManager->add($this->forum, $data);
                $this->redirect()->toRoute('forum/index', ['id_forum'=>$this->forum->getId()]);
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }


    public function forgottenPasswordAction():ViewModel
    {
        $form = new PasswordResetForm();

        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                $email = $data['email'];
                $user = $this->entityManager->getRepository(User::class)->findOneBy([
                    'email' => $email,
                    'status' => User::STATUS_ACTIVE
                ]);

                if($user){
                    $this->signManager->resetPassword($user);
                }

                $this->redirect()->toRoute('forum/forum_login', ['id_forum'=>Module::getForumId()]);
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function passRecoveryAction():ViewModel
    {
        $view = new ViewModel();

        $token = $this->params()->fromRoute('token', 'no-token');
        $user = $this->entityManager->getRepository(User::class)->findOneBy(
            ['passwordResetToken'=>$token]
        );
        //check user existance
        if(!$user){
            $view->setTemplate('pass-recovery-failed');
            return $view;
        }
        //check datetime
        $limit = new \DateTime();
        $interval = new \DateInterval('PT2H');

        $limit->sub($interval);

        //check if limit si depassed
        if($user->getPasswordResetTokenCreationDate() < $limit){
            $view->setTemplate('pass-recovery-failed');
            return $view;
        }

        $form = new PasswordChangeForm('reset');

        $view->setVariable('form', $form);

        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data=$form->getData();
                $this->signManager->updateResettedPassword($data['new_password'], $user);
            }
        }

        return $view;
    }

}