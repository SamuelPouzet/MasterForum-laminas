<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/12/2019
 * Time: 22:56
 */

namespace Css\Controller;



use Css\Entity\CssValue;
use Css\Form\CssKeyForm;
use Css\Form\CssValueForm;
use Css\Service\CssManager;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Module;

class AdminController extends AbstractActionController
{

    protected $entityManager;

    protected $cssManager;

    public function __construct(EntityManager $em, CssManager $cssManager)
    {
        $this->entityManager = $em;
        $this->cssManager = $cssManager;
    }


    public function newAction():ViewModel
    {
        $form = new CssKeyForm();

        if($this->getRequest()->isPost()){
            $request = $this->params()->fromPost();
            $form->setData($request);

            if($form->isValid()){
                $data = $form->getData();

                $this->cssManager->add($data);
                //$this->redirect()->toRoute('communication');
            }
        }

        return new ViewModel([
            'form'=>$form,
        ]);
    }

    public function newValueAction()
    {
        $form = new CssValueForm('new-key', $this->entityManager);

        if($this->getRequest()->isPost()){
            $request = $this->params()->fromPost();
            $form->setData($request);

            if($form->isValid()){
                $data = $form->getData();

                $this->cssManager->addValue($data);
                $this->redirect()->toRoute('admin/css', ['id_forum'=>\User\Module::getForumId()]);
            }
        }

        return new ViewModel([
            'form'=>$form,
        ]);
    }

    public function editValueAction()
    {

        $id = (int) $this->params()->fromRoute('id', -1);

        $value = $this->entityManager->getRepository(CssValue::class)->find($id);

        if( !$value || $value->getKey()->getForumId() != Module::getForumId())
        {
            throw new \Exception('Data not found');
        }

        $form = new CssValueForm('edit-key', $this->entityManager);

        if($this->getRequest()->isPost()){
            $request = $this->params()->fromPost();
            $form->setData($request);

            if($form->isValid()){
                $data = $form->getData();

                $this->cssManager->updValue($value, $data);
                $this->redirect()->toRoute('admin/css', ['id_forum'=>\User\Module::getForumId()]);
            }
        }

        $form->bind($value);

        return new ViewModel([
            'form'=>$form,
        ]);
    }

    public function deleteValueAction():void
    {

        $id = (int) $this->params()->fromRoute('id', -1);

        $value = $this->entityManager->getRepository(CssValue::class)->find($id);

        if( !$value || $value->getKey()->getForumId() != Module::getForumId())
        {
            throw new \Exception('Data not found');
        }

        $this->cssManager->removeValue($value);
        $this->redirect()->toRoute('admin/css', ['id_forum'=>\User\Module::getForumId()]);
    }

}