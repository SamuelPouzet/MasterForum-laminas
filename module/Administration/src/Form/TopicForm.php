<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 12/07/2020
 * Time: 13:32
 */

namespace Administration\Form;


use Application\Entity\ForumCategory;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;

class TopicForm extends Form
{

    protected $entityManager;

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->getFormElements();
    }

    protected function getFormElements()
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

        $data=[];
        if(isset($this->options['forum'])){
            $categories = $this->options['forum']->getCategories();
            foreach($categories as $category){
                foreach($category->getSubjects() as $subject){
                    $data[$subject->getId()] = $subject->getTitle();
                }

            }
        }

        $this->add([
            'type' => Select::class,
            'name' => 'subject_id',
            'attributes' => [
                'id' => 'subject_id'
            ],
            'options' => [
                'label' => 'Sujet',
                'value_options'=>$data,
            ],
        ]);

        $this->add([
            'type' => Select::class,
            'name' => 'status',
            'attributes' => [
                'id' => 'status'
            ],
            'options' => [
                'label' => 'type',
                'value_options'=>ForumCategory::STATUS,
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