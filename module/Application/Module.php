<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\EventManager\EventInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {

        $application    = $e->getTarget();
        $eventManager   = $e->getApplication()->getEventManager();
        $serviceManager = $application->getServiceManager();
        $sharedManager  = $application->getEventManager()->getSharedManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $entityManager = $serviceManager->get('doctrine.entitymanager.orm_default');
        $evm = $entityManager->getEventManager();
        $evm->addEventListener(array(\Doctrine\ORM\Events::postLoad), new \Application\Service\ServiceManagerListener($serviceManager));


    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig() 
    {
        return array(
            'abstract_factories' => array(),
            'aliases' => array(),
            'factories' => array(
                'Zend\Authentication\AuthenticationService' => function($serviceManager) {
                    return $serviceManager->get('doctrine.authenticationservice.orm_default');  
                },
            ),
            'invokables' => array(),
            'services' => array(),
            'shared' => array(),
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
