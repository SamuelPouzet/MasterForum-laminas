<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 28/07/2020
 * Time: 18:19
 */

namespace Css\Form;

use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;

class CssKeyForm extends Form
{
    protected $scenario;

    public function __construct($scenario = 'create', $entityManager = null, $role = null)
    {
        // Define form name
        parent::__construct('newCssAttribute-form');

        $this->scenario = $scenario;

        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // (Optionally) set action for this form
        $this->setAttribute('action', '');
        //$this->setAttribute('enctype', 'multipart/form-data');

        $this->addElements();
        $this->addInputFilters();
    }

    protected function addElements()
    {
        $this->add([
            'type'  => Text::class,
            'name' => 'header',
            'attributes' => [
                'id' => 'header'
            ],
            'options' => [
                'label' => 'Header',
            ],
        ]);

        // Add the Submit button
        $this->add([
            'type'  => Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Enregistrer',
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

    protected function addInputFilters()
    {

    }


}