<?php

namespace Mobile\SymmetryBundle\Symmetry\Demo;

use Mobile\SymmetryBundle\Entity\Registry;


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SymmetryDemo
 *
 * @author admin
 */

class SymmetryDemo   {
    
  private $is_installed = false;
  private $doctrine;
  private $server_path;

  public function __construct($controller, $server_path){      
      
      $this->doctrine = $controller->getDoctrine();
      $this->server_path = $server_path;
      
  }
  
  
  public function execute(){
      
      if(!$this->installed()){
               
          $this->installDemo();
          
      }
  }
  
  
  public function installed(){      
              
      $entity = $this->doctrine
                 ->getEntityManager()
                 ->getRepository('MobileSymmetryBundle:Registry')
                 ->findBy( array('service_name' => 'AcmeBTestSupplier'));
      
      if($entity){
          $this->is_installed = true;
      }
      return $this->is_installed;
           
  }
  
  private function installDemo(){
      
        $registry1 = new Registry();
        $registry1->setActive(1);
        $registry1->setClassName("AcmeBTestSupplierProxy");
        $registry1->setDescription("service provided by the supplier company");
        $registry1->setMethodName("getOrderId");
        $registry1->setResource($this->server_path."symmetry/server/supplier/");
        $registry1->setServiceName("AcmeBTestSupplier");
        $registry1->setUpdatedAt(new \Datetime("now"));
        $registry1->setCreatedAt(new \Datetime("now"));
        
        $registry2 = new Registry();
        $registry2->setActive(1);
        $registry2->setClassName("AcmeCTestBankProxy");
        $registry2->setDescription("service provided by the bank company");
        $registry2->setMethodName("getAuthorization");
        $registry2->setResource($this->server_path."symmetry/server/bank/");
        $registry2->setServiceName("AcmeCTestBank");
        $registry2->setUpdatedAt(new \Datetime("now"));
        $registry2->setCreatedAt(new \Datetime("now"));
        
        $registry3 = new Registry();
        $registry3->setActive(1);
        $registry3->setClassName("AcmeDTestDeliveryProxy");
        $registry3->setDescription("service provided by the delivery company");
        $registry3->setMethodName("getDeliveryCode");
        $registry3->setResource($this->server_path."symmetry/server/delivery_company/");
        $registry3->setServiceName("AcmeDTestDelivery");
        $registry3->setUpdatedAt(new \Datetime("now"));
        $registry3->setCreatedAt(new \Datetime("now"));        
                
        $this->doctrine->getEntityManager()->persist($registry1);
        $this->doctrine->getEntityManager()->persist($registry2);
        $this->doctrine->getEntityManager()->persist($registry3);
        $this->doctrine->getEntityManager()->flush();
        
  }
  
  
      
}