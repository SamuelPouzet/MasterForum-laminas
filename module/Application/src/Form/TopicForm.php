<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 02/08/2020
 * Time: 15:26
 */

namespace Application\Form;


use Application\Entity\ForumSubject;
use Doctrine\ORM\EntityManager;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;

class TopicForm extends Form
{

    protected $entityManager;
    protected $subject;

    public function __construct(EntityManager $em, ForumSubject $subject, $name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->getFormElements();
    }

    protected  function getFormElements():void
    {
        $this->add([
            'type' => Text::class,
            'name' => 'title',
            'attributes' => [
                'id' => 'title'
            ],
            'options' => [
                'label' => 'Titre',
            ],
        ]);

        $this->add([
            'type' => Text::class,
            'name' => 'catchphrase',
            'attributes' => [
                'id' => 'catchphrase'
            ],
            'options' => [
                'label' => "Phrase d'accroche",
            ],
        ]);
    }



}