<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 28/12/2019
 * Time: 12:35
 */

namespace Css\Controller;




use Css\Entity\CssKey;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;

class CssGeneratorController extends AbstractActionController
{

    protected $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    public function showAction():?ViewModel
    {

        $id_forum = $this->params()->fromRoute('id_forum', 0);

        $classes = $this->entityManager->getRepository(CssKey::class)->findBy([
            "forum_id"=>$id_forum,
        ]);

        $viewModel = new ViewModel();
        $viewModel->setVariables([
            "classes"=>$classes,
        ]);
        $viewModel->setTemplate(null);
        $viewModel->setTerminal(true);

        return $viewModel;

    }


}