<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 12/07/2020
 * Time: 13:32
 */

namespace Administration\Form;


use Application\Entity\ForumCategory;
use Doctrine\ORM\EntityManager;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;
use User\Module;

class SubjectForm extends Form
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager, $name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->entityManager = $entityManager;
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
        $categories = $this->entityManager->getRepository(ForumCategory::class)->findBy([
            'forum_id'=>Module::getForumId(),
        ]);

        foreach($categories as $category){
            $data[$category->getId()] = $category->getName();
        }


        $this->add([
            'type' => Select::class,
            'name' => 'category_id',
            'attributes' => [
                'id' => 'category_id'
            ],
            'options' => [
                'label' => 'Catégorie',
                'value_options'=>$data,
            ],
        ]);

        $this->add([
            'type' => Select::class,
            'name' => 'type',
            'attributes' => [
                'id' => 'type'
            ],
            'options' => [
                'label' => 'type (@todo)',
                'value_options'=>ForumCategory::STATUS,
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