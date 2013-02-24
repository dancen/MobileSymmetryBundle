<?php

namespace Mobile\SymmetryBundle\Symmetry\RemoteObjects;

use Mobile\SymmetryBundle\Symmetry\SymmetryRemoteObject;
use Mobile\SymmetryBundle\Symmetry\RemoteObjects\SymmetryRegistry;
use Mobile\SymmetryBundle\Symmetry\SymmetrySecurityManager;
use Mobile\SymmetryBundle\Symmetry\RemoteObjects\RemoteObject;
use Mobile\SymmetryBundle\Symmetry\SymmetryRemoteErrors;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author admin
 */
class SymmetryClient extends SymmetryRemoteObject  {
        
    private $service_name;
    private $parameters;
    private $registry;
    private $param;
    private $security_manager;
    private $controller;
    
    private function __construct($controller){
        
        
        // set the registry object
        
            $this->controller = $controller;
            $this->registry = SymmetryRegistry::getRegistry($this->controller);
            
            
         // LOGGING
         \Mobile\LoggingBundle\Model\Logging\LogFactory::createLogManager($this->controller)
                       ->setMessageLog("SYMMETRY - CREATING THE CLIENT",
                                       \Mobile\LoggingBundle\Model\Logging\LogLevel::LOG_NOTICE,
                                       \Mobile\LoggingBundle\Model\Logging\LogStage::LOG_PROD,
                                       "");
            
    }
    
    public static function getInstance($controller){
      $instance = null;
      if($instance == null) {
          $instance = new SymmetryClient($controller);
      }
      return $instance;
    }
    
    public function setServiceName( $service_name, $parameters = null ){ 
        
        // set the service name and the parameters passed to the remote method
        
        $this->service_name = $service_name;
        $this->parameters = $parameters;
        return $this;
    }
    
    protected function initializeSymmetrySecurityManager(){        
        
        // inizialize the security manager creating the signature
        
        $this->security_manager = new SymmetrySecurityManager($this->registry);
        $this->setParam();
    }
    
    private function getSecurityManager(){        
        return $this->security_manager;
    }
    
    public function setParam(){
        
        // set the query string passed over the internet throught curl 
            
        $this->param = $this->registry[$this->service_name]["servicename"]."|"
                         .$this->registry[$this->service_name]["method"]."|"
                         .$this->getSecurityManager()->getSignature($this->service_name)."|"
                         .serialize($this->parameters);
        
       
        
    }
    
    public function getParam(){  
        return $this->param;
    }
    
    public function getStub(){
        
        // call the security manager method
        
        $this->initializeSymmetrySecurityManager();
        
        
        // call the pack method to prepare curl data
        
        $ch = $this->pack( $this->param );
        
        // execute the curl calling
             
        $stub_client = unserialize(curl_exec($ch)); 
        
              
        // LOGGING
         \Mobile\LoggingBundle\Model\Logging\LogFactory::createLogManager($this->controller)
                       ->setMessageLog("SYMMETRY - UNSERIALIZING THE STUB CLIENT",
                                       \Mobile\LoggingBundle\Model\Logging\LogLevel::LOG_NOTICE,
                                       \Mobile\LoggingBundle\Model\Logging\LogStage::LOG_PROD,
                                       "".serialize($stub_client));
        
        
        // check if the result returned is a RemoteObject
         
        if( $stub_client instanceof RemoteObject ){
            
            // check if the RemoteObject has errors
            
            if( $stub_client->getError() == "" ){
                
                    // call the RemoteObject method getOutput
                
                    $output = $stub_client->getOutput();
                    
                    // decode the output results
                    $response = unserialize( gzuncompress( base64_decode( $output )));
                    
            } else {
                
                // if the RemoteObject has errors set the response
                
                $response = $stub_client->getError();
            }
            
        } else {
            
            // if the result is not a RemoteObject set the response
            
            $response = SymmetryRemoteErrors::REMOTE_OBJECT_INVALID;
            
            // LOGGING
            \Mobile\LoggingBundle\Model\Logging\LogFactory::createLogManager($this->controller)
                       ->setMessageLog("SYMMETRY - REMOTE_OBJECT_INVALID",
                                       \Mobile\LoggingBundle\Model\Logging\LogLevel::LOG_ERROR,
                                       \Mobile\LoggingBundle\Model\Logging\LogStage::LOG_PROD,
                                       "".$response);
            
        }
        
        // Check if any error occured
        if(curl_errno($ch))
        {
           
            $response = 'Curl error: ' . curl_error($ch);
        }

        
        
        curl_close($ch);
        
        // return the response from the service supplier
               
        return $response;        
    }
    
     private function pack($param){
         
        // get the resource for the service supplier 
         
        $url = $this->registry[$this->service_name]["url"]."".$param;
        
        
         // LOGGING
         \Mobile\LoggingBundle\Model\Logging\LogFactory::createLogManager($this->controller)
                       ->setMessageLog("SYMMETRY - PACKING THE STUB CLIENT WITH CURL",
                                       \Mobile\LoggingBundle\Model\Logging\LogLevel::LOG_NOTICE,
                                       \Mobile\LoggingBundle\Model\Logging\LogStage::LOG_PROD,
                                       "".$url);
        
         
        // initialize the curl calling 
        
        $ch = curl_init($url);
        
        $options = array(
            CURLOPT_RETURNTRANSFER => true,         // return web page
            CURLOPT_HEADER         => false,        // don't return headers
            CURLOPT_FOLLOWLOCATION => true,         // follow redirects
            CURLOPT_ENCODING       => "",           // handle all encodings
            CURLOPT_USERAGENT      => "SYMMETRY",   // who am i
            CURLOPT_AUTOREFERER    => true,         // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
            CURLOPT_TIMEOUT        => 120,          // timeout on response
            CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
            CURLOPT_POST            => 1,           // i am sending post data
            CURLOPT_POSTFIELDS     => $param,       // this are my post vars
            CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
            CURLOPT_SSL_VERIFYPEER => false,        //
            CURLOPT_VERBOSE        => 1             //
        );
        
        curl_setopt_array($ch,$options);
        
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // return the prepared curl data
        
        return $ch;
    }
    
}

