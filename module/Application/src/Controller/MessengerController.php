<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 20/07/2020
 * Time: 13:20
 */

namespace Application\Controller;


use Application\Controller\Base\BaseController;
use Application\Entity\Messenger\Message;
use Application\Entity\Messenger\Responses;
use Application\Form\Messenger\ResponseForm;
use Application\Service\Messenger\ResponseManager;
use Doctrine\ORM\EntityManager;
use Laminas\View\Model\ViewModel;
use User\Module;

class MessengerController extends BaseController
{

    protected $entityManager;

    protected $responseManager;

    public function __construct(EntityManager $entityManager, ResponseManager $rm)
    {
        $this->entityManager = $entityManager;
        $this->responseManager= $rm;
    }

    public function indexAction():ViewModel
    {

        $messages = $this->entityManager->getRepository(Message::class)->findAll();

        return new ViewModel([
            'messages'=>$messages,
        ]);

    }

    public function conversationAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $myself = $this->currentUser();

        $message = $this->entityManager->getRepository(Message::class)->find($id);
        $responses = $this->entityManager->getRepository(Responses::class)->findBy([
            'message_id'=>$message->getId(),
        ],[
            'date_creation'=>'desc',
            ]
        );

        $form = new ResponseForm();

        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);

            if($form->isValid()){
                $data=$form->getData();
                $data['user'] = $myself;
                $data['message'] = $message;
                $this->responseManager->add($data);
                $this->redirect()->toRoute('forum/messenger', ['id_forum'=>Module::getForumId()]);
            }
        }

        return new ViewModel([
            'message'=>$message,
            'responses'=>$responses,
            'form'=>$form,
        ]);
    }

}