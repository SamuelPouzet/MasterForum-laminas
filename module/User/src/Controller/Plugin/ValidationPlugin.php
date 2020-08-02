<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 02/08/2020
 * Time: 10:38
 */

namespace User\Controller\Plugin;


use Doctrine\ORM\EntityManager;
use Laminas\Authentication\Result;
use Laminas\Mvc\Controller\Plugin\AbstractPlugin;
use Laminas\Uri\Uri;
use User\Service\AuthManager;

class ValidationPlugin extends AbstractPlugin
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

    public function __invoke(array $data, string $redirectUrl):array
    {

        // Perform login attempt.
        $result = $this->authService->validate($data);

        // Check result.
        if ($result->getCode() == Result::SUCCESS) {

            // Get redirect URL.

            if (!empty($redirectUrl)) {
                // The below check is to prevent possible redirect attack
                // (if someone tries to redirect user to another domain).
                $uri = new Uri($redirectUrl);
                if (!$uri->isValid() || $uri->getHost()!=null){
                    throw new \Exception('Incorrect redirect URL: ' . $redirectUrl);
                }
                return ['error'=>false, 'uri'=>$uri];
            }else{
                return ['error'=>false, 'uri'=>null];
            }
        } else {
            return ['error'=>true, 'uri'=>null];
        }

    }

}