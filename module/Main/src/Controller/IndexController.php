<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 09/08/2020
 * Time: 08:27
 */

namespace Main\Controller;


use Application\Entity\Forum;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction():ViewModel
    {

        $fora = $this->entityManager->getRepository(Forum::class)->findAll();

        return new ViewModel([
            'fora' => $fora,
        ]);

    }

}