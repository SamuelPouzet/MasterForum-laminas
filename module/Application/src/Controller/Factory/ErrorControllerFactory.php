<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 25/07/2020
 * Time: 08:22
 */

namespace Application\Controller\Factory;


use Application\Controller\ErrorController;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ErrorControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ErrorController();
    }

}