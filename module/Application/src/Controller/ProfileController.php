<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 16/07/2020
 * Time: 18:19
 */

namespace Application\Controller;


use Application\Controller\Base\BaseController;
use Application\Entity\Forum;
use Application\Form\ProfileForm;
use Application\Service\ProfileManager;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Module;

class ProfileController extends AbstractActionController
{

    protected $entityManager;

    protected $profileManager;

    public function __construct(EntityManager $entityManager, ProfileManager $profileManager)
    {
        $this->entityManager = $entityManager;
        $this->profileManager = $profileManager;
    }

    public function indexAction():ViewModel
    {

        $forum = $this->entityManager->getRepository(Forum::class)->find(Module::getForumId());

        $form = new ProfileForm();

        $user = $this->currentUser();

        $scenario = $user->getProfile() !== null?'update':'create';


        if($this->getRequest()->isPost()){
            $data = $this->params()->fromPost();
            $form->setData($data);
            if($form->isValid()){
                $data = $form->getData();
                if($scenario == 'create'){
                    $this->profileManager->add($user, $data);
                }else{
                    $this->profileManager->update($user->getProfile(), $data);
                }
            }
        }


        if($scenario == 'update'){
            $form->bind($user->getProfile());
        }

        return new ViewModel([
            'form' => $form,
            'forum' => $forum,
        ]);
    }

}