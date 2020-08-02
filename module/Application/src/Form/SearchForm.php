<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 12/07/2020
 * Time: 13:32
 */

namespace Application\Form;


use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;

class SearchForm extends Form
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
            'name' => 'search',
            'attributes' => [
                'id' => 'search'
            ],
            'options' => [
                'label' => 'Element à chercher',
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