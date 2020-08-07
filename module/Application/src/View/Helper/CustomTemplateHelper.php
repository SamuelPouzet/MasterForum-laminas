<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 01/08/2020
 * Time: 09:07
 */

namespace Application\View\Helper;


use Application\Entity\ForumTopic;
use Application\Entity\Template\CustomResponse;
use Doctrine\ORM\EntityManager;
use Laminas\View\Helper\AbstractHelper;

class CustomTemplateHelper extends AbstractHelper
{

    protected $topic;

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setTopic(ForumTopic $topic):CustomTemplateHelper
    {
        $this->topic = $topic;
        return $this;
    }


    public function render():string
    {
        $render = " <section class=\"row post\">";
        $render .= "<section class=\"post-avatar col-lg-3\">";
        $render .= $this->renderAuthor();
        $render .= "</section>";
        $render .= "<section class=\"post-content col-lg-9\">";

        $render .= $this->renderHtml();

        $render .= "</section>";
        $render .= "</section>";


        return $render;
    }

    protected function renderAuthor()
    {
        $author = $this->topic->getCustomResponse()->getAuthor();
        $render = "<article class=\"avatar-header col-lg-12\">";
        $render .= $author->getAlias();
        $render .= "</article>";

        return $render;
    }

    protected function renderHtml()
    {
        $customTemplate = $this->entityManager->getRepository(CustomResponse::class)->find( $this->topic->getType() );
        $html = $customTemplate->getHtml();
        $variables = json_decode( $customTemplate->getVariables(), true);

        $data = json_decode( $this->topic->getCustomResponse()->getContent(), true );
        foreach($variables as $variable){
            if(!$data[$variable]){
                continue;
            }
            $search = ["**" . $variable . "**", '%%' . $variable . '%%'];
            $replace = [nl2br($data[$variable]), '<img src="' . $data[$variable] . '">'];
            $html = str_replace($search, $replace, $html);

        }

        return $html;
    }
}
