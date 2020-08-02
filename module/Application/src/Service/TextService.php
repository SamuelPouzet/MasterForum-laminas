<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/07/2020
 * Time: 14:38
 */

namespace Application\Service;


use Application\Entity\SamCodeElement;
use Doctrine\ORM\EntityManager;

class TextService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var array
     */
    protected $samcodeElements = [];

    /**
     * TextService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function formatText(string $text):string
    {
        $this->getElements();

    }

    private function getElements():array
    {
        if(count($this->samcodeElements) == 0){
            $this->samcodeElements = $this->entityManager->getRepository(SamCodeElement::class)->findAll();
        }
        return $this->samcodeElements;
    }

}