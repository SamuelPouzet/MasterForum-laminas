<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 03/08/2020
 * Time: 07:15
 */

namespace User\Controller\Plugin;


use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\Plugin\AbstractPlugin;
use User\Service\AuthManager;

class DelogPlugin extends AbstractPlugin
{

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Authentication service.
     * @var Laminas\Authentication\AuthenticationService
     */
    private $authService;

    /**
     * Constructor.
     */
    public function __construct(EntityManager $entityManager, AuthManager $authService)
    {
        $this->entityManager = $entityManager;
        $this->authService = $authService;
    }

    public function __invoke()
    {
        $this->authService->logout();
    }


}