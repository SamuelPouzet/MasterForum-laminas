<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 09/08/2020
 * Time: 09:40
 */

namespace Main\Controller;


use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Main\Form\NewForumForm;

class NewForumController extends AbstractActionController
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction(): ViewModel
    {
        $form = new NewForumForm();

        return new ViewModel([
            'form' => $form,
        ]);
    }
}