<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 02/08/2020
 * Time: 15:26
 */

namespace Application\Form;


use Laminas\Form\Element\Collection;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Textarea;
use Laminas\Form\Form;

class TopicForm extends Form
{

    protected $customTemplate;

    public function __construct($customTemplate, $name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->customTemplate = $customTemplate;
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

        // Add the Submit button
        $this->add([
            'type' => Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Rechercher',
                'id' => 'submit',
            ],
        ]);

        $this->add([
            'type' => Csrf::class,
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
                    'timeout' => 600
                ]
            ]
        ]);
    }



}