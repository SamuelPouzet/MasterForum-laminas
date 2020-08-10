<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 19/07/2020
 * Time: 10:43
 */

namespace Main;

use Css\Controller\CssGeneratorController;
use Css\Controller\Factory\CssGeneratorControllerFactory;
use Css\Service\CssManager;
use Css\Service\Factory\CssManagerFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Main\Controller\Factory\IndexControllerFactory;
use Main\Controller\Factory\NewForumControllerFactory;
use Main\Controller\IndexController;
use Main\Controller\NewForumController;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'newForum' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/new-forum',
                    'defaults' => [
                        'controller' => NewForumController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories'=>[
            IndexController::class=>IndexControllerFactory::class,
            NewForumController::class=>NewForumControllerFactory::class,

        ]
    ],
    'service_manager' => [
        'factories' => [

        ],
    ],

    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],

    'access_filter' => [
        'controllers' => [
            IndexController::class => [
                ['actions' => ['index'], 'allow' => '*'],
            ],
            NewForumController::class => [
                ['actions' => ['index'], 'allow' => '*'],
            ],
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'css/application'           => __DIR__ . '/../view/layout/application.phtml',
            'css/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
