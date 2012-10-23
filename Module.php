<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/SanAuth for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SanAuth;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories'=>array(
		'SanAuth\Model\MyAuthStorage' => function($sm){
		    return new \SanAuth\Model\MyAuthStorage('zf_tutorial');  
		},
		
		'AuthService' => function($sm) {
		    $dbAdapter      = $sm->get('Zend\Db\Adapter\Adapter');
                    $dbTableAuthAdapter  = new DbTableAuthAdapter($dbAdapter, 'users','user_name','pass_word', 'MD5(?)');
		    
		    $authService = new AuthenticationService();
		    $authService->setAdapter($dbTableAuthAdapter);
		     
		    return $authService;
		},
            ),
        );
    }

}
