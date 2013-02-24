<?php

namespace Mobile\SymmetryBundle\Symmetry\RemoteObjects;
 

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AcmeBTestSupplierProxy
 *
 * @author admin
 */

class AcmeDTestDeliveryProxy  {
    
    public function __construct(){} 
  
    public static function getDeliveryCode($params){
        
        $concrete_obj = new \Mobile\SymmetryBundle\Model\AcmeDTestDelivery();
        $concrete_obj->setDeliveryType($params[0]);
        $concrete_obj->setDeliveryDestination($params[1]);
        $concrete_obj->setCustomerCode($params[2]);
        $concrete_obj->setCreatedAt(new \DateTime());
        return $concrete_obj->getDeliveryCode();


    }
    
    
       
}