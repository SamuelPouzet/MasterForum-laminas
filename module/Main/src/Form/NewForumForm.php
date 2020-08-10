<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 09/08/2020
 * Time: 19:04
 */

namespace Main\Form;


use Administration\Form\SubjectForm;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Textarea;
use Laminas\Form\Form;
use User\Form\UserForm;

class NewForumForm extends Form
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        // Define form name
        parent::__construct('newForum-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');

        $this->addElements();
        $this->addInputFilter();
    }

    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements()
    {
        // Add "email" field
        $this->add([
            'type'  => Text::class,
            'name' => 'name',
            'options' => [
                'label' => 'Nom du forum',
            ],
        ]);

        // Add "password" field
        $this->add([
            'type'  => Textarea::class,
            'name' => 'description',
            'options' => [
                'label' => 'description',
            ],
        ]);

        // Add "remember_me" field
        $this->add([
            'type'  => Text::class,
            'name' => "icon",
            'options' => [
                'label' => 'Icone de présentation',
            ],
        ]);

        $this->add([
            'type'=>ForumOwnerForm::class,
            "name"=>"owner"
            ]);


        // Add the CSRF field
        $this->add([
            'type' => 'csrf',
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
                    'timeout' => 600
                ]
            ],
        ]);

        // Add the Submit button
        $this->add([
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Enregistrer',
                'id' => 'submit',
            ],
        ]);
    }

    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter()
    {

    }
}