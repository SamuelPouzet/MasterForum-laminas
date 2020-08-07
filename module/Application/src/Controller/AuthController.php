<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 02/08/2020
 * Time: 08:46
 */

namespace Application\Controller;

use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Form\LoginForm;
use User\Module;
use User\Service\AuthManager;

class AuthController extends AbstractActionController
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {

        $this->entityManager = $entityManager;

    }

    public function loginAction()
    {

        // Retrieve the redirect URL (if passed). We will redirect the user to this
        // URL after successfull login.
        $redirectUrl = (string)$this->params()->fromQuery('redirectUrl', '');
        if (strlen($redirectUrl)>2048) {
            throw new \Exception("Too long redirectUrl argument passed");
        }

        // Check if we do not have users in database at all. If so, create
        // the 'Admin' user.
        //$this->userManager->createAdminUserIfNotExists();

        // Create login form
        $form = new LoginForm();
        $form->get('redirect_url')->setValue($redirectUrl);

        // Store login status.
        $isLoginError = false;

        // Check if user has submitted the form
        if ($this->getRequest()->isPost()) {

            // Fill in the form with POST data
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Validate form
            if($form->isValid()) {
                // Get filtered and validated data
                $data = $form->getData();
                $redirectUrl = $this->params()->fromPost('redirect_url', '');

                $response = $this->validation($data, $redirectUrl);

                if( isset($response['error']) && $response['error'] == false){

                    if(isset($response['uri']) && $response['uri'] !== null){
                        $this->redirect()->toUrl( $response['uri'] );
                    }else{
                        $this->redirect()->toRoute('forum/forum', ['action' => 'index', 'id_forum'=> Module::getForumId() ]);
                    }
                }else{
                    $isLoginError = true;
                }
            } else {
                $isLoginError = true;
            }
        }

        $view = new ViewModel([
            'form' => $form,
            'isLoginError' => $isLoginError,
            'redirectUrl' => $redirectUrl
        ]);

        return $view;
    }

    public function logoutAction()
    {
        $this->delog();
        $this->redirect()->toRoute('forum/index', ['id_forum'=>Module::getForumId()]);
    }

}