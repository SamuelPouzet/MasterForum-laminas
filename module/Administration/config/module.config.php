<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Administration;

use Administration\Controller\CategoryController;
use Administration\Controller\CssController;
use Administration\Controller\Factory\CategoryControllerFactory;
use Administration\Controller\Factory\CssControllerFactory;
use Administration\Controller\Factory\PostControllerFactory;
use Administration\Controller\Factory\SubjectControllerFactory;
use Administration\Controller\Factory\TopicControllerFactory;
use Administration\Controller\Factory\UserControllerFactory;
use Administration\Controller\IndexController;
use Administration\Controller\Factory\IndexControllerFactory;
use Administration\Controller\PostController;
use Administration\Controller\SubjectController;
use Administration\Controller\TopicController;
use Administration\Controller\UserController;
use Administration\Service\Factory\ForumResponseManagerFactory;
use Administration\Service\Factory\ForumSubjectManagerFactory;
use Administration\Service\Factory\ForumTopicManagerFactory;
use Administration\Service\Factory\UserManagerFactory;
use Administration\Service\ForumResponseManager;
use Administration\Service\ForumSubjectManager;
use Administration\Service\ForumTopicManager;
use Administration\Service\UserManager;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'admin' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/admin/:id_forum',
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'index' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/',
                            'defaults' => [
                                'controller' => IndexController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'dashboard' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/dashboard[/:action[/:id]]',
                            'defaults' => [
                                'controller' => IndexController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'user' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/user[/:action[/:id]]',
                            'defaults' => [
                                'controller' => UserController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'pages' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/pages',
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'category' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route'    => '/category[/:action[/:id]]',
                                    'defaults' => [
                                        'controller' => CategoryController::class,
                                        'action'     => 'index',
                                    ],
                                ],
                            ],
                            'subject' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route'    => '/subject[/:action[/:id]]',
                                    'defaults' => [
                                        'controller' => SubjectController::class,
                                        'action'     => 'index',
                                    ],
                                ],
                            ],
                            'topic' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route'    => '/topic[/:action[/:id]]',
                                    'defaults' => [
                                        'controller' => TopicController::class,
                                        'action'     => 'index',
                                    ],
                                ],
                            ],
                            'post' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route'    => '/post[/:action[/:id]]',
                                    'defaults' => [
                                        'controller' => PostController::class,
                                        'action'     => 'index',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    //end pages block
                    'css' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/style[/:action[/:id]]',
                            'defaults' => [
                                'controller' => CssController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],

                ],

            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            IndexController::class=>IndexControllerFactory::class,
            UserController::class=>UserControllerFactory::class,
            CategoryController::class=>CategoryControllerFactory::class,
            SubjectController::class=>SubjectControllerFactory::class,
            TopicController::class=>TopicControllerFactory::class,
            PostController::class=>PostControllerFactory::class,
            CssController::class=>CssControllerFactory::class,
        ],
    ],
    'controller_plugins' => [
        'factories' => [


        ],
        'aliases' => [

        ],
    ],
    'service_manager' => [
        'factories' => [
            UserManager::class=>UserManagerFactory::class,
            ForumSubjectManager::class=>ForumSubjectManagerFactory::class,
            ForumTopicManager::class=>ForumTopicManagerFactory::class,
            ForumResponseManager::class=>ForumResponseManagerFactory::class,
        ],
    ],
    'view_helpers' => [
        'factories' => [

        ],
        'aliases' => [

        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/administration'   => __DIR__ . '/../view/layout/administration.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'access_filter' => [
        'controllers' => [
            IndexController::class => [
                // public page
                ['actions' => ['index'], 'allow' => '*'],
            ],
            UserController::class => [
                // public page
                ['actions' => ['index', 'edit', 'new', 'password'], 'allow' => '*'],
            ],
            CategoryController::class => [
                // public page
                ['actions' => ['index'], 'allow' => '*'],
            ],
            SubjectController::class => [
                // public page
                ['actions' => ['index', 'new', 'edit'], 'allow' => '*'],
            ],
            TopicController::class => [
                // public page
                ['actions' => ['index', 'new', 'edit'], 'allow' => '*'],
            ],
            PostController::class => [
                // public page
                ['actions' => ['index', 'new', 'edit'], 'allow' => '*'],
            ],
            CssController::class => [
                // public page
                ['actions' => ['index', 'new', 'newValue', 'editValue', 'deleteValue', 'edit'], 'allow' => '*'],
            ],

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
];
