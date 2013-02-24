<?php

namespace Mobile\SymmetryBundle\Symmetry;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author admin
 */
class SymmetrySecurityManager {
        
    
    private $server_registry;
    
    
    public function __construct($registry){
        $this->server_registry = $registry;
    }
    
    public function getSignature($service_name){
        return $this->createSignature($service_name);
    }
              
    public function createSignature($service_name){
        $service = $this->server_registry[$service_name];
        return md5(serialize($service));
    }
    
    public function checkSignature($service_name,$client_signature){        
        $valid_signature = false;
        if($client_signature === $this->getSignature($service_name)){
            $valid_signature = true;
        } 
        return $valid_signature;        
    }
    
    
}

