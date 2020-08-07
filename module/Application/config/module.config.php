<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application;

use Application\Controller\AccountController;
use Application\Controller\CssController;
use Application\Controller\ErrorController;
use Application\Controller\Factory\AccountControllerFactory;
use Application\Controller\Factory\AuthControllerFactory as AuthenticationControllerFactory;
use Application\Controller\Factory\CssControllerFactory;
use Application\Controller\Factory\ErrorControllerFactory;
use Application\Controller\Factory\ForumControllerFactory;
use Application\Controller\Factory\MessengerControllerFactory;
use Application\Controller\Factory\ProfileControllerFactory;
use Application\Controller\Factory\ResponseControllerFactory;
use Application\Controller\Factory\SearchControllerFactory;
use Application\Controller\Factory\SignControllerFactory;
use Application\Controller\Factory\SubjectControllerFactory;
use Application\Controller\Factory\TopicControllerFactory;
use Application\Controller\ForumController;
use Application\Controller\MessengerController;
use Application\Controller\Plugin\Factory\TextFormaterPluginFactory;
use Application\Controller\Plugin\TextFormatterPlugin;
use Application\Controller\ProfileController;
use Application\Controller\ResponseController;
use Application\Controller\SearchController;
use Application\Controller\SignController;
use Application\Controller\SubjectController;
use Application\Controller\TopicController;
use Application\Service\AccountManager;
use Application\Service\Factory\AccountManagerFactory;
use Application\Service\Factory\MailerServiceFactory;
use Application\Service\Factory\NavigationManagerFactory;
use Application\Service\Factory\ProfileManagerFactory;
use Application\Service\Factory\ResponseManagerFactory;
use Application\Service\Factory\SignManagerFactory;
use Application\Service\Factory\TextServiceFactory;
use Application\Service\Factory\TopicManagerFactory;
use Application\Service\MailerService;
use Application\Service\NavigationManager;
use Application\Service\ProfileManager;
use Application\Service\ResponseManager;
use Application\Service\SignManager;
use Application\Service\TextService;
use Application\Service\TopicManager;
use Application\View\Helper\CustomTemplateHelper;
use Application\View\Helper\Factory\CustomTemplateHelperFactory;
use Application\View\Helper\Navigation;
use Application\View\Helper\Factory\NavigationFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Application\Controller\AuthController as AuthenticationController;
use User\Service\Adapter\Factory\AuthAdapterFactory;
use User\Service\Adapter\AuthAdapter;
use \Application\Service\Messenger\ResponseManager as MessengerResponseManager;
use \Application\Service\Messenger\Factory\ResponseManagerFactory as MessengerResponseManagerFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'forum' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/forum[/:id_forum]',
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'index' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/',
                            'defaults' => [
                                'controller' => ForumController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'forum' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/index[/:action[/:id]]',
                            'defaults' => [
                                'controller' => ForumController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'subject' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/subject[/:action[/:id_subject]]',
                            'defaults' => [
                                'controller' => SubjectController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'topic' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/topic[/:action[/:id[/:numpage]]]',
                            'defaults' => [
                                'controller' => TopicController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'response' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/response[/:action[/:id_topic]]',
                            'defaults' => [
                                'controller' => ResponseController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'search' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/search[/:action]',
                            'defaults' => [
                                'controller' => SearchController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'profile' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/profile[/:action]',
                            'defaults' => [
                                'controller' => ProfileController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'account' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/account[/:action]',
                            'defaults' => [
                                'controller' => AccountController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'sign' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/sign[/:action[/:token]]',
                            'defaults' => [
                                'controller' => SignController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'forum_login' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/login',
                            'defaults' => [
                                'controller' => AuthenticationController::class,
                                'action'     => 'login',
                            ],
                        ],
                    ],
                    'forum_logout' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/logout',
                            'defaults' => [
                                'controller' => AuthenticationController::class,
                                'action'     => 'logout',
                            ],
                        ],
                    ],
                    'messenger' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/messenger[/:action[/:id]]',
                            'defaults' => [
                                'controller' => MessengerController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'not-authorized' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/not-authorized[/:action[/:id]]',
                            'defaults' => [
                                'controller' => ErrorController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'css' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/css[/:action[/:id]]',
                            'defaults' => [
                                'controller' => CssController::class,
                                'action'     => 'show',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            ForumController::class=>ForumControllerFactory::class,
            SubjectController::class=>SubjectControllerFactory::class,
            TopicController::class=>TopicControllerFactory::class,
            ResponseController::class=>ResponseControllerFactory::class,
            SearchController::class=>SearchControllerFactory::class,
            ProfileController::class=>ProfileControllerFactory::class,
            AccountController::class=>AccountControllerFactory::class,
            SignController::class=>SignControllerFactory::class,
            MessengerController::class=>MessengerControllerFactory::class,
            ErrorController::class=>ErrorControllerFactory::class,
            CssController::class=>CssControllerFactory::class,
            AuthenticationController::class=>AuthenticationControllerFactory::class,
            ],
    ],
    'controller_plugins' => [
        'factories' => [
            TextFormatterPlugin::class => TextFormaterPluginFactory::class,
        ],
        'aliases' => [
            'textFormatter' => TextFormatterPlugin::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            ResponseManager::class => ResponseManagerFactory::class,
            TextService::class => TextServiceFactory::class,
            AuthAdapter::class=>AuthAdapterFactory::class,
            NavigationManager::class=>NavigationManagerFactory::class,
            ProfileManager::class=>ProfileManagerFactory::class,
            AccountManager::class=>AccountManagerFactory::class,
            SignManager::class=>SignManagerFactory::class,
            MailerService::class=>MailerServiceFactory::class,
            MessengerResponseManager::class=>MessengerResponseManagerFactory::class,
            TopicManager::class=>TopicManagerFactory::class,
        ],
    ],
    'view_helpers' => [
        'factories' => [
            Navigation::class => NavigationFactory::class,
            CustomTemplateHelper::class=>CustomTemplateHelperFactory::class,
        ],
        'aliases' => [
            'nav' => Navigation::class,
            'customTemplate' => CustomTemplateHelper::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/application'           => __DIR__ . '/../view/layout/application.phtml',
            'index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'access_filter' => [
        'controllers' => [
            ForumController::class => [
                // public page
                ['actions' => ['index'], 'allow' => '*'],
            ],
            SubjectController::class => [
                // public page
                ['actions' => ['view'], 'allow' => '*'],
            ],
            TopicController::class => [
                // public page
                ['actions' => ['view'], 'allow' => '*'],
                ['actions' => ['add'], 'allow' => '@'],
            ],
            ResponseController::class => [
                // public page
                ['actions' => ['view'], 'allow' => '*'],
                ['actions' => ['add'], 'allow' => '@'],
            ],
            SearchController::class => [
                ['actions' => ['index'], 'allow' => '*'],
            ],
            ProfileController::class => [
                ['actions' => ['index'], 'allow' => '@'],
            ],
            AccountController::class => [
                ['actions' => ['index'], 'allow' => '@'],
            ],
            SignController::class => [
                ['actions' => ['index', 'forgottenPassword', 'passRecovery'], 'allow' => '*'],
            ],
            MessengerController::class => [
                ['actions' => ['index', 'conversation'], 'allow' => '@'],
            ],
            CssController::class => [
                ['actions' => ['show'], 'allow' => "*"],
            ],
            AuthenticationController::class => [
                ['actions' => ['login', 'logout'], 'allow' => "*"],
            ]
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
