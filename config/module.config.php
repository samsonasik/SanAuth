<?php

return array(
    'controllers' => array(
        'factories' => array(
            'SanAuth\Controller\Auth' => function($service) {
                if ($service instanceof \Zend\ServiceManager\ServiceLocatorAwareInterface) {
                    $service = $service->getServiceLocator();
                }
                $controller = new \SanAuth\Controller\AuthController(
                    $service->get('AuthService'),
                    $service->get('SanAuth\Model\MyAuthStorage')
                ),
            },
            'SanAuth\Controller\Success' => function($service) {
                if ($service instanceof \Zend\ServiceManager\ServiceLocatorAwareInterface) {
                    $service = $service->getServiceLocator();
                }
                $controller = new \SanAuth\Controller\SuccessController(
                    $service->get('AuthService')
                ),
            }
        ),
    ),
    'router' => array(
        'routes' => array(

            'login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SanAuth\Controller',
                        'controller'    => 'Auth',
                        'action'        => 'login',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'process' => array(
                        'type'    => 'Segment',
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
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/success',
                    'defaults' => array(
                        '__NAMESPACE__' => 'SanAuth\Controller',
                        'controller'    => 'Success',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
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
);
