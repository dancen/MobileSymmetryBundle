<?php

namespace Mobile\SymmetryBundle\Symmetry\RemoteObjects;

use Mobile\SymmetryBundle\Symmetry\SymmetryRemoteErrors;
use Mobile\SymmetryBundle\Symmetry\RemoteObjects\SymmetryRemote;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RemoteObject
 *
 * @author admin
 */

class RemoteObject implements SymmetryRemote {
    
  private $object;
  private $method;
  private $error;
  private $output;
  private $callback;
  private $parameters = array();
    
  private function __construct(){}
  
  public static function getInstance(){
      $instance = null;
      if($instance == null) {
          $instance = new RemoteObject();
      }
      return $instance;
  }
  
  public function setObject($object){
      $this->object = $object;
      return $this;
  }
  
  public function setError($error){
      $this->error = $error;
      return $this;
  }
  
  public function getError(){
      return $this->error;   
  }
  
  public function getOutput(){
      return $this->output;   
  } 
  
  public function setMethod($method){
      $this->method = $method;
      return $this;
  }
  
  public function setRemoteParameters($params){
      $this->parameters = $params;
      return $this;
  }
    
  public function invoke(){
      
      // instancing two variables 
      // for the object and the method
      
      $obj = $this->object;
      $method = $this->method;
      
      // check if the method exists
      
      if(method_exists($obj, $method)) {
          
          // check if the parameters is an array
          
          if(is_array($this->parameters)){
              
            
            // execute the method and encode the result
              
            $resource = $obj->$method($this->parameters);
            $this->output = base64_encode(gzcompress(serialize($resource))); 
          
            
          } else {
              
            // if parameters is not an array set the error
              
            $this->setError(SymmetryRemoteErrors::REMOTE_PARAMS_INVALID);
          }
      
      } else { 
          
        // if the method does not exists set the error
          
        $this->setError(SymmetryRemoteErrors::REMOTE_METHOD_INVALID);
      }
      
      // return the RemoteObject itself
      return $this;
  }
  
  public function getCallBack(){
      return $this->callback;
  }
  
  public function setCallBack($callback){
      $this->callback = $callback;
  }
  
     
}