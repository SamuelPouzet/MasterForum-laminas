<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 16/07/2020
 * Time: 07:53
 */

namespace Application\Service;


use Application\Entity\Forum;
use Doctrine\ORM\EntityManager;
use Laminas\View\Helper\Url;
use User\Entity\User;
use User\Module;
use User\Service\AuthenticationService;

class NavigationManager
{


    protected $entityManager;

    protected $urlHelper;

    protected $authenticationManager;

    protected $forum;

    public function __construct(EntityManager $entityManager, Url $urlHelper, AuthenticationService $authenticationService)
    {
        $this->entityManager = $entityManager;
        $this->urlHelper = $urlHelper;
        $this->authenticationManager = $authenticationService;
        $this->setForum();
        //die(var_dump($this->authenticationManager->getIdentity()));
    }


    protected function setForum():void
    {
        if($this->forum == null){
            $forum = Module::getForumId();;
            $this->forum = $this->entityManager->getRepository(Forum::class)->find($forum);
        }
    }

    /**
     * @return mixed
     */
    public function getForum():?Forum
    {
        return $this->forum;
    }

    public function getMenuElements()
    {
        $url = $this->urlHelper;

        $elements = [];

        $element = [
            'name' => "index",
            'link' => $url('forum/forum', ['action'=>'index', 'id_forum'=>$this->forum->getId() ]),
        ];

        $elements[] = $element;

        $element = [
            'name' => "Rechercher",
            'link' => $url('forum/search', ['action'=>'index', 'id_forum'=>$this->forum->getId() ]),
        ];

        $elements[] = $element;

        if($this->authenticationManager->hasIdentity()){

            $user = $this->entityManager->getRepository(User::class)
                ->findOneBy([
                    'email' =>$this->authenticationManager->getIdentity(),
                    'forum_id'=>Module::getForumId()
                ]);

            $dropdown = [];
            $dropdown[] = [
                'name'=>'Mon compte',
                'link' => $url('forum/account', ['id_forum'=>$this->forum->getId() ]),
            ];

            $dropdown[] = [
                'name'=>'Mon profil',
                'link' => $url('forum/profile', ['id_forum'=>$this->forum->getId() ]),
            ];

            $dropdown[] =                     [
                'name'=>'Déconnexion',
                'link' => $url('forum/forum_logout', ['id_forum'=>$this->forum->getId() ]),
            ];



            $element = [
                'name' => $user->getAlias(),
                'dropdown'=>$dropdown,

            ];
            $elements[] = $element;
        }else{
            $element = [
                'name' => "Connexion",
                'link' => $url('forum/forum_login', ['id_forum'=>$this->forum->getId() ]),
            ];
            $elements[] = $element;

            $element = [
                'name' => "Inscription",
                'link' => $url('forum/sign', ['id_forum'=>$this->forum->getId() ]),
            ];
            $elements[] = $element;
        }



        return $elements;



    }

}