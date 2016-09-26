<?php

namespace SanAuth\Service;

use SanAuth\Model\MyAuthStorage;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

class AuthenticationFactory
{
    public function __invoke($container)
    {
        $storage = new MyAuthStorage();
        $dbAdapter = $container->get('Zend\Db\Adapter\Adapter');
        $dbTableAuthAdapter  = new DbTableAuthAdapter($dbAdapter, 'users','user_name','pass_word', 'MD5(?)');
        
        $authService = new AuthenticationService();
        $authService->setAdapter($dbTableAuthAdapter);
        $authService->setStorage($storage);
                
        return $authService;
    }
}
