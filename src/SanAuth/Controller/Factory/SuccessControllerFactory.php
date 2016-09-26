<?php

namespace SanAuth\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use SanAuth\Controller\SuccessController;

class SuccessControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authService = $container->get('AuthService');

        return new SuccessController($authService);
    }

}
