<?php

namespace Mobile\SymmetryBundle\Symmetry\RemoteObjects;

use Mobile\SymmetryBundle\Symmetry\SymmetryRemoteObject;
use Mobile\SymmetryBundle\Symmetry\RemoteObjects\RemoteObject;
use Mobile\SymmetryBundle\Symmetry\SymmetryRemoteErrors;
use Mobile\SymmetryBundle\Symmetry\SymmetrySecurityManager;
use Mobile\SymmetryBundle\Symmetry\RemoteObjects\SymmetryRegistry;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author admin
 */
class SymmetryServer extends SymmetryRemoteObject  {
            
    private $service;
    private $method;
    private $signature;
    private $parameters = array();
    private $security_manager;
    private $registry;
    private $controller;
    
       
    private function __construct($controller){
        
            $this->controller = $controller;
            
            // set the registry for the symmetry server
            
            $this->registry = SymmetryRegistry::getRegistry($this->controller);
            
    }
    
    public static function getInstance($controller){
      
        // singleton pattern
        
      $instance = null;
      if($instance == null) {
          $instance = new SymmetryServer($controller);
      }
      return $instance;
    }
    
        
    public function setServiceParams($params){
        
        // explode parameter received from query string
        
        $sym_array = explode("|",$params);
        $this->service = $sym_array[0];
        $this->method = $sym_array[1];
        $this->signature = $sym_array[2];
        $this->parameters = unserialize($sym_array[3]);
        return $this;
    }
    
    protected function initializeSymmetrySecurityManager(){
        
        // initialize the security manager
        
        $this->security_manager = new SymmetrySecurityManager($this->registry);
    }
    
    public function getSecurityManager(){
        return $this->security_manager;
    }
    
    public function getStub(){
        
        // call the security manager
        
        $this->initializeSymmetrySecurityManager();
        $services = $this->registry;
        
        // LOGGING
                \Mobile\LoggingBundle\Model\Logging\LogFactory::createLogManager($this->controller)
                       ->setMessageLog("SYMMETRY - SECURITY MANAGER INITIALIZED",
                                       \Mobile\LoggingBundle\Model\Logging\LogLevel::LOG_NOTICE,
                                       \Mobile\LoggingBundle\Model\Logging\LogStage::LOG_PROD,
                                       "".serialize($services));
        
        
        // check if the service is active
        
        $active = $services[$this->service]["active"];
        
        if( $active == 1 ){
            
            // check if the signature received is valid
            
            $valid_signature = $this->security_manager
                            ->checkSignature($services[$this->service]["servicename"],
                                            $this->signature);

            
            if( $valid_signature == true ){

                // instance variables for the object, the method and method parameters
                
                $object = $services[$this->service]["cls"];
                $method = $this->method;
                $params = $this->parameters;
                $log_msg = serialize($object)."__".$method."__".$params;
                
                
                // LOGGING
                \Mobile\LoggingBundle\Model\Logging\LogFactory::createLogManager($this->controller)
                       ->setMessageLog("SYMMETRY - SERVER IS INVOKING THE OBJECT",
                                       \Mobile\LoggingBundle\Model\Logging\LogLevel::LOG_NOTICE,
                                       \Mobile\LoggingBundle\Model\Logging\LogStage::LOG_PROD,
                                       "".$log_msg);
                
                                
                // create a Remote Object and execute the service
                
                $remote_object = RemoteObject::getInstance()->setObject($object)
                                                ->setMethod($method)
                                                ->setRemoteParameters($params)
                                                ->invoke();  
               
                
            } else {
                
                // if the signature does not match set a RemoteObject error
                
                $remote_object = RemoteObject::getInstance()->setError(SymmetryRemoteErrors::REMOTE_SIGNATURE_INVALID);
                
                // LOGGING
                \Mobile\LoggingBundle\Model\Logging\LogFactory::createLogManager($this->controller)
                        ->setMessageLog("SYMMETRY - REMOTE_SIGNATURE_INVALID",
                                        \Mobile\LoggingBundle\Model\Logging\LogLevel::LOG_WARNING,
                                        \Mobile\LoggingBundle\Model\Logging\LogStage::LOG_PROD,
                                        "".SymmetryRemoteErrors::REMOTE_SIGNATURE_INVALID);
                
            }
            
        } else {
            
            // if the service is not active (temporarly or permanently) set a RemoteObject error
            
            $remote_object = RemoteObject::getInstance()->setError(SymmetryRemoteErrors::REMOTE_SERVICE_INACTIVE); 
            
             // LOGGING
                \Mobile\LoggingBundle\Model\Logging\LogFactory::createLogManager($this->controller)
                        ->setMessageLog("SYMMETRY - REMOTE_SERVICE_INACTIVE",
                                        \Mobile\LoggingBundle\Model\Logging\LogLevel::LOG_ERROR,
                                        \Mobile\LoggingBundle\Model\Logging\LogStage::LOG_PROD,
                                        "".SymmetryRemoteErrors::REMOTE_SERVICE_INACTIVE);
            
            
        }
        
        // return a RemoteObject to the curl client
        
        return serialize($remote_object);
    }
    
    
    
}

