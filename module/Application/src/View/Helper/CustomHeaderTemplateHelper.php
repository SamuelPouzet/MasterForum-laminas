<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 01/08/2020
 * Time: 09:07
 */

namespace Application\View\Helper;


use Application\Entity\Forum;
use Application\Entity\ForumTopic;
use Laminas\View\Helper\AbstractHelper;

class CustomHeaderTemplateHelper extends AbstractHelper
{

    protected $forum;


    public function __construct()
    {

    }

    public function setForum(Forum $forum):CustomHeaderTemplateHelper
    {
        $this->forum = $forum;
        return $this;
    }


    public function render():string
    {
        $render = " <section class=\"row post\">";
        $render .= "<section class=\"post-content col-lg-12\">";

        $render .= $this->renderHtml();

        $render .= "</section>";
        $render .= "</section>";


        return $render;
    }

    protected function renderHtml()
    {
        $html = $this->topic->getCustomTemplate()->getHtml();
        $variables = json_decode($this->topic->getCustomTemplate()->getVariables(), true);

        $data = json_decode( $this->topic->getCustomResponse()->getContent(), true );
        foreach($variables as $variable){
            if(!$data[$variable]){
                continue;
            }
            $search = ["**" . $variable . "**", '%%' . $variable . '%%'];
            $replace = [nl2br($data[$variable]), '<img src="' . $data[$variable] . '>'];
            $html = str_replace($search, $replace, $html);

        }

        return $html;
    }
}
