<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 12/07/2020
 * Time: 13:32
 */

namespace Administration\Form;


use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Textarea;
use Laminas\Form\Form;

class UserForm extends Form
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->getFormElements();
    }

    protected function getFormElements()
    {
        $this->add([
            'type' => Text::class,
            'name' => 'email',
            'attributes' => [
                'id' => 'email'
            ],
            'options' => [
                'label' => 'Email',
            ],
        ]);

        $this->add([
            'type' => Text::class,
            'name' => 'alias',
            'attributes' => [
                'id' => 'alias',
            ],
            'options' => [
                'label' => 'Pseudonyme',
            ],
        ]);

        $this->add([
            'type' => Text::class,
            'name' => 'name',
            'attributes' => [
                'id' => 'name'
            ],
            'options' => [
                'label' => 'Nom',
            ],
        ]);

        $this->add([
            'type' => Text::class,
            'name' => 'firstName',
            'attributes' => [
                'id' => 'firstname'
            ],
            'options' => [
                'label' => 'Prénom',
            ],
        ]);


        // Add "status" field
        $this->add([
            'type'  => 'select',
            'name' => 'status',
            'options' => [
                'label' => 'Status',
                'value_options' => [
                    1 => 'Active',
                    2 => 'Retired',
                ]
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