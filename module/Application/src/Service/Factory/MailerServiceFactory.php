<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 18/07/2020
 * Time: 11:13
 */

namespace Application\Service\Factory;


use Application\Service\MailerService;
use Interop\Container\ContainerInterface;
use Laminas\Mvc\Service\ViewPhpRendererFactory;
use Laminas\ServiceManager\Factory\FactoryInterface;

class MailerServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');

        if(!isset($config['mailer'])){
            throw new \Exception('mailer config not found');
        }
        $viewRenderer = $container->get('ViewRenderer');

        return new MailerService($config['mailer'],$viewRenderer);
    }

}