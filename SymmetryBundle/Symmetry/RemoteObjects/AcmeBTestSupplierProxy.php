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

class AcmeBTestSupplierProxy  {
    
    public function __construct(){} 
  
    public static function getOrderId($params){
        
        $concrete_obj = new \Mobile\SymmetryBundle\Model\AcmeBTestSupplier();
        $concrete_obj->setCustomerId($params[0]);
        $concrete_obj->setProductCode($params[1]);
        $concrete_obj->setQuantity($params[2]);
        $concrete_obj->setDelivery($params[3]);
        $concrete_obj->setCreatedAt(new \DateTime());
        return $concrete_obj->getOrderId();


    }
    
    
       
}