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

class AcmeCTestBankProxy  {
    
    public function __construct(){} 
  
    public static function getAuthorization($params){
        
        $concrete_obj = new \Mobile\SymmetryBundle\Model\AcmeCTestBank();
        $concrete_obj->setBankCustomerRef($params[0]);
        $concrete_obj->setDebit($params[1]);
        $concrete_obj->setMerchantRef($params[2]);
        //$concrete_obj->setCreatedAt(new \DateTime());
        return $concrete_obj->getAuthorization();


    }
    
    
       
}