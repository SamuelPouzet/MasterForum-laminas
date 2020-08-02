<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 16/07/2020
 * Time: 07:40
 */

namespace Application\View\Helper;


use Application\Service\NavigationManager;
use Laminas\View\Helper\AbstractHelper;

class Navigation extends AbstractHelper
{

    protected $navigationManager;

    protected $forum;

    public function __construct(NavigationManager $navigationManager)
    {
        $this->navigationManager = $navigationManager;
        $this->forum = $this->navigationManager->getForum();
    }

    public function render():string
    {

        //die(var_dump( $this->forum->getElements()->getHeaderImage() ));

        $render = '<header class="img-top"><img src="' . $this->forum->getElements()->getHeaderImage() . '"></header>';
        $render .= "<nav class=\"navbar navbar-expand-md navbar-dark mb-4\" role=\"navigation\">";
        $render .= $this->renderHeader();
        $render .= "<div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">";
        $render .= "<ul class=\"navbar-nav\">";
        $render .= $this->renderItems();
        $render .= "</ul>";
        $render .= "</div>";
        $render .= "</div>";
        $render .= "</nav>";

        return $render;

    }


    private function renderHeader()
    {
        $render = "<div class=\"container\">";
        $render .= "<div class=\"navbar-header\">";
        $render .= "<button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">";
        $render .= "<span class=\"navbar-toggler-icon\"></span>";
        $render .= "</button>";
        $render .= "<a class=\"navbar-brand\" href=\"#\">";
        if($this->forum->getIcon()){
            $render .= "<img class=\"img-thumbnail\" src=\"" . $this->forum->getIcon() . "\" alt=\"\">";
        }
        $render .= $this->forum->getName() . "</a>";
        $render .= "</div>";

        return $render;
    }

    private function renderItems()
    {
        $render = '';

        $menuElements = $this->navigationManager->getMenuElements();

        foreach ($menuElements as $element){
            if(!isset($element['dropdown'])) {
                $render .= "<li class=\"nav-item\">";
                $render .= "<a class=\"nav-link\" href=\"" . $element['link'] . "\">" . $element['name'] . "<span class=\"sr-only\">(current)</span></a>";
                $render .= "</li>";
            }else{
                $render .= '<li class="dropdown">';
                $render .= '<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">';
                $render .= $element['name'] . ' <b class="caret"></b>';
                $render .= '</a>';
                $render .= '<ul class="dropdown-menu">';

                foreach ($element['dropdown'] as $dropdown) {
                    $link = isset($dropdown['link']) ? $dropdown['link'] : '#';
                    $label = isset($dropdown['name']) ? $dropdown['name'] : 'noname';

                    $render .= '<li>';
                    $render .= '<a href="'.$link.'">'.$label.'</a>';
                    $render .= '</li>';
                }

                $render .= '</ul>';
            }

        }
        return $render;
    }

}