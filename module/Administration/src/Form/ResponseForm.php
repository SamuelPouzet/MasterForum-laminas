<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 12/07/2020
 * Time: 13:32
 */

namespace Administration\Form;


use Application\Entity\ForumCategory;
use Application\Entity\ForumResponse;
use Application\Entity\ForumTopic;
use Doctrine\ORM\EntityManager;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Textarea;
use Laminas\Form\Form;
use User\Entity\User;

class ResponseForm extends Form
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
            'type' => Textarea::class,
            'name' => 'content',
            'attributes' => [
                'id' => 'content'
            ],
            'options' => [
                'label' => "Contenu",
            ],
        ]);

        $data=[];
        $topics = $this->entityManager->getRepository(ForumTopic::class)->findTopicsInForum();
        foreach($topics as $topic){
            $data[$topic->getId()] = $topic->getTitle();
        }
        $this->add([
            'type' => Select::class,
            'name' => 'topic_id',
            'attributes' => [
                'id' => 'topic_id'
            ],
            'options' => [
                'label' => 'Topic',
                'value_options'=>$data,
            ],
        ]);

        $data=[];
        $users = $this->entityManager->getRepository(User::class)->findAllUsersInForum();
        foreach($users as $user){
            $data[$user->getId()] = $user->getAlias();
        }

        $this->add([
            'type' => Select::class,
            'name' => 'author_id',
            'attributes' => [
                'id' => 'author_id'
            ],
            'options' => [
                'label' => 'Auteur',
                'value_options'=>$data,
            ],
        ]);
/*
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
*/
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