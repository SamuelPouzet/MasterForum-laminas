<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 25/07/2020
 * Time: 16:14
 */

namespace Application\Form\Messenger;


use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Textarea;
use Laminas\Form\Form;

class ResponseForm extends Form
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->getFormElements();
    }

    protected function getFormElements()
    {
        $this->add([
            'type' => Textarea::class,
            'name' => 'content',
            'attributes' => [
                'id' => 'content'
            ],
            'options' => [
                'label' => 'Content',
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