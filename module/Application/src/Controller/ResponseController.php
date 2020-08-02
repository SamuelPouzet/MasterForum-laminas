<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/07/2020
 * Time: 11:12
 */

namespace Application\Controller;


use Application\Controller\Base\BaseController;
use Application\Entity\ForumTopic;
use Application\Form\ResponseForm;
use Application\Service\ResponseManager;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Module;

class ResponseController extends AbstractActionController
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var ResponseManager
     */
    protected $responseManager;

    /**
     * ResponseController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, ResponseManager $responseManager)
    {
        $this->entityManager = $entityManager;
        $this->responseManager = $responseManager;
    }


    public function addAction():ViewModel
    {

        $idTopic = (int) $this->params()->fromRoute('id_topic', -1);

        $topic = $this->entityManager->getRepository(ForumTopic::class)->findTopicInForum(
            $idTopic
        );

        if(!$topic){
            $this->getResponse()->setStatusCode(404);
        }

        $form = new ResponseForm();

        if($this->getRequest()->isPost()){
            $request = $this->params()->fromPost();
            $form->setData($request);

            if($form->isValid()){
                $data = $form->getData();

                $userForum = $this->currentUser();

                if($userForum){
                    $data['user'] = $userForum;
                    $this->responseManager->add($data, $topic);
                }

                $this->redirect()->toRoute('forum/topic', ['action'=>'view', 'id_forum'=>Module::getForumId(), 'id_topic'=>$idTopic ]);
            }

        }

        return new ViewModel([
            'form' => $form,
        ]);


    }

}