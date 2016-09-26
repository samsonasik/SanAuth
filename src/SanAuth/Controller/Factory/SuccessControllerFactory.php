<?php

namespace SanAuth\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use SanAuth\Controller\SuccessController;

class SuccessControllerFactory
{
    public function __invoke($container)
    {
        if ($container instanceof ServiceLocatorAwareInterface) {
            $container = $container->getServiceLocator();
        }
        $authService = $container->get('AuthService');

        return new SuccessController($authService);
    }

}
