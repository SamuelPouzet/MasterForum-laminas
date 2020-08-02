<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 19/07/2020
 * Time: 10:44
 */
declare(strict_types=1);
namespace Css;

namespace Css;

class Module
{
    public function getConfig() : array
    {
        return include __DIR__ . '/../config/module.config.php';
    }

}