<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 28/07/2020
 * Time: 19:49
 */

namespace Administration\Controller;


use Css\Controller\AdminController;
use Css\Entity\CssKey;
use Laminas\View\Model\ViewModel;
use User\Module;

class CssController extends AdminController
{

    public function indexAction():ViewModel
    {
        $styles = $this->entityManager->getRepository(CssKey::class)->findBy([
            'forum_id'=>Module::getForumId(),
        ]);

        return new ViewModel([
            'styles'=>$styles,
        ]);
    }

    public function newAction():ViewModel
    {
        return parent::newAction();
    }


}