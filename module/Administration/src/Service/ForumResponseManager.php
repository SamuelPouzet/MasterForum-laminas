<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 26/07/2020
 * Time: 12:35
 */

namespace Administration\Service;


use Application\Entity\Forum;
use Application\Entity\ForumCategory;
use Application\Entity\ForumResponse;
use Application\Entity\ForumSubject;
use Application\Entity\ForumTopic;
use Doctrine\ORM\EntityManager;
use User\Entity\User;
use User\Module;
use User\Service\AuthenticationService;

class ForumResponseManager
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(array $data):void
    {
        $post = new ForumResponse();

        $forum = $this->entityManager->getRepository(Forum::class)->find(Module::getForumId());

        if(!$forum){
            throw new \Exception('forum inexistant');
        }

        $post->setContent($data['content']);

        $topic = $this->entityManager->getRepository(ForumTopic::class)->find((int)$data['topic_id']);
        $post->setTopic($topic);

        $author = $this->entityManager->getRepository(User::class)->find((int)$data['author_id']);
        $post->setAuthor($author);

        $post->setDateCreated(new \DateTime());

        //$topic->setStatus($data['status']);

        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

    public function update(ForumResponse $post, array $data):void
    {

        if(isset($data['content']) && $post->getContent() !== $data['content']){
            $post->setContent($data['content']);
        }


        if(isset($data['topic_id']) && $post->getTopicId() !== $data['topic_id']){
            $topic = $this->entityManager->getRepository(ForumTopic::class)->find((int)$data['topic_id']);
            $post->setTopic($topic);
        }

        if(isset($data['author_id']) && $post->getAuthorId() !== $data['author_id']){
            $author = $this->entityManager->getRepository(User::class)->find((int)$data['author_id']);
            $post->setAuthor($author);
        }



        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }
}