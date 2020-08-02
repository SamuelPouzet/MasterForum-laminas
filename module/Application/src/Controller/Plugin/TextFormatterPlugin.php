<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/07/2020
 * Time: 17:02
 */

namespace Application\Controller\Plugin;


use Application\Entity\SamCodeElement;
use Doctrine\ORM\EntityManager;
use Zend\Cache\Storage\Plugin\AbstractPlugin;

final class TextFormatterPlugin extends AbstractPlugin
{

    protected $entityManager;

    protected $samcodeElements = [];

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(string $text):string
    {
        if(count($this->samcodeElements) == 0)
        {
            $this->samcodeElements = $this->entityManager->getRepository(SamCodeElement::class)->findAll();
        }


        foreach( $this->samcodeElements as $element) {
            $start = '{{' . $element->getKeyStart() . '}}';
            $end = '{{' . $element->getKeyEnd() . '}}';
            $number_start = substr_count($start, $text);
            $number_end = substr_count($end(), $text);
            if($number_start != $number_end){
                die('erreur');
            }
            if($number_start > 0){
                $htmlStart = '<' . $element->getHtml() . '>';
                $htmlEnd = '</' . $element->getHtml() . '>';
                str_replace([$start, $end], [$htmlStart, $htmlEnd], $text);
            }
        }

    }
}