<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 16/07/2020
 * Time: 20:20
 */

namespace Application\Controller;


use Application\Controller\Base\BaseController;
use Application\Form\AccountForm;
use Application\Service\AccountManager;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AccountController extends AbstractActionController
{
    protected $entityManager;
    protected $accountManager;

    public function __construct(EntityManager $entityManager, AccountManager $accountManager)
    {
        $this->entityManager = $entityManager;
        $this->accountManager = $accountManager;
    }

    public function indexAction():ViewModel
    {
        $form = new AccountForm();
        $user = $this->currentUser();

        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                $this->accountManager->update($user, $data);
            }
        }

        $form->bind($user);
        return new ViewModel([
            'form' => $form,
        ]);
    }

}