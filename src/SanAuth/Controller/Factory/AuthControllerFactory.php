<?php

namespace SanAuth\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use SanAuth\Controller\AuthController;

class AuthControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authService = $container->get('AuthService');

        return new AuthController($authService, $authService->getStorage());
    }

}
