<?php
namespace SanAuth;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return array(
    'controllers' => array(
        'factories' => array(
            Controller\AuthController::class => Controller\Factory\AuthControllerFactory::class,
            Controller\SuccessController::class => Controller\Factory\SuccessControllerFactory::class,
        ),
    ),
    'router' => array(
        'routes' => array(
            'login' => array(
                'type' => Literal::class,
                'options' => array(
                    'route'    => '/auth',
                    'defaults' => array(
                        'controller' => Controller\AuthController::class,
                        'action'        => 'login',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type' => Segment::class,
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),

            'success' => array(
                'type' => Literal::class,
                'options' => array(
                    'route'    => '/success',
                    'defaults' => array(
                        'controller' => Controller\SuccessController::class,
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => Segment::class,
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),

        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'SanAuth' => __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
        'aliases' => array(
            'Zend\Authentication\AuthenticationService' => 'AuthService',
        ),
        'factories' => array(
            'AuthService' => Service\AuthenticationFactory::class,
        ),
    ),
);
