<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 29/07/2020
 * Time: 07:14
 */

namespace Css\Form;


use Css\Entity\CssKey;
use Doctrine\ORM\EntityManager;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;
use User\Module;

class CssValueForm extends Form
{
    protected $scenario;

    protected $entityManager = null;

    public function __construct($scenario = 'create', EntityManager $entityManager = null, $role = null)
    {
        // Define form name
        parent::__construct('newCssAttribute-form');

        $this->scenario = $scenario;
        $this->entityManager = $entityManager;

        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // (Optionally) set action for this form
        $this->setAttribute('action', '');
        //$this->setAttribute('enctype', 'multipart/form-data');

        $this->addElements();
        $this->addInputFilters();
    }

    protected function addElements():void
    {
        $this->add([
            'type'  => Text::class,
            'name' => 'attribute',
            'attributes' => [
                'id' => 'attribute'
            ],
            'options' => [
                'label' => 'Attribut',
            ],
        ]);

        $this->add([
            'type'  => Text::class,
            'name' => 'value',
            'attributes' => [
                'id' => 'value'
            ],
            'options' => [
                'label' => 'Valeur',
            ],
        ]);

        $data=[];
        $keys=$this->entityManager->getRepository(CssKey::class)->findBy(
            ['forum_id'=>Module::getForumId()],
        );
        foreach ($keys as $key)
        {
            $data[$key->getId()]=$key->getHeader();
        }

        $this->add([
            'type'  => Select::class,
            'name' => 'key',
            'attributes' => [
                'id' => 'Key'
            ],
            'options' => [
                'label' => 'Clé associée',
                'value_options'=>$data,
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