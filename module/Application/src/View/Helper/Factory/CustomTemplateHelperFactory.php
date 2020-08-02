<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 01/08/2020
 * Time: 09:09
 */

namespace Application\View\Helper\Factory;


use Application\View\Helper\CustomTemplateHelper;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class CustomTemplateHelperFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new CustomTemplateHelper();
    }

}