<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 12/07/2020
 * Time: 13:28
 */

namespace Application\Controller;


use Application\Controller\Base\BaseController;
use Application\Entity\ForumResponse;
use Application\Form\SearchForm;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

/**
 * Class SearchController
 * @package Application\Controller
 */
class SearchController extends AbstractActionController
{

    /**
     * @var EntityManager EntityManager
     */
    protected  $entityManager;

    /**
     * SearchController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction():ViewModel
    {
        $form = new SearchForm();

        $model = new ViewModel([
            'form' => $form,
        ]);

        if($this->getRequest()->isPost()){
            $request = $this->params()->fromPost();
            $form->setData($request);

            if($form->isValid()){
                $data = $form->getData();

                $return = $this->entityManager->getRepository(ForumResponse::class)->searchElementInForum($data['search'], $this->forum->getId());

                $model->setVariable('searchreturn', true);
                $model->setVariable('return', $return);
            }

        }


        return $model;
    }

}