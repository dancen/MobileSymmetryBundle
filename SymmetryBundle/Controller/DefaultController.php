<?php

namespace Mobile\SymmetryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mobile\SymmetryBundle\Symmetry\Demo\SymmetryDemo;


class DefaultController extends Controller
{
    
    
    // Symmetry client / server role: customer
    
    
     public function symmetryClientCustomerAction()
    {                
               
        
       $params = array();
       
       // customer_id stored in supplier system
       $params[0] = "acme23000002343";
       
       // product_code stored in supplier system
       $params[1] = "TSRR12293";
       
       // quantity setted by customer client
       $params[2] = "25";
       
       // delivery type requested by the delivery service
       $params[3] = "express";      
            
         
       $stub_client = $this->get("symmetry_manager")
                           ->createClient($this, "AcmeBTestSupplier",$params)
                           ->getStub();
       
          
       return new \Symfony\Component\HttpFoundation\Response($stub_client);
        
    } 
   
    
    
    
    // Symmetry client / server role: supplier
    
    

    public function symmetryServerSupplierAction($param)
    {                
      
        $stub_server = $this->get("symmetry_manager")
                       ->createServer($this)
                       ->setServiceParams($param)
                       ->getStub();        
        
        
        
        // contacting the bank symmetry service                  
        
       $params = array();
       
       // customer_id stored in bank system
       $params[0] = "5546664yywu88339999300000002";
       
       // costs of the service required
       $params[1] = "550,28";       
       
       // merchant code
       $params[2] = "kjhdchwqdh888we88";       
       
       
       $stub_client = $this->get("symmetry_manager")
                           ->createClient($this, "AcmeCTestBank",$params)
                           ->getStub();
        
        
        
        
        return new \Symfony\Component\HttpFoundation\Response($stub_server);              
        
    } 
    
    
    
   
       
    
    public function symmetryClientSupplierToDeliveryCompanyAction($param)
    {
        
    
       // contacting the delivery company symmetry service  
       
       
       $params = array();
       
       // delivery_type choosen by the client and managed by the delivery company
       $params[0] = "express";
       
       // delivery destination address in the delivery company format
       $params[1] = "via Garibaldi 23, Pavia, Italy, IT";   
       
       // customer account stored in Delivery company system
       $params[2] = "ARRSDDFFYY7728882";        
       
       
       $stub_client = $this->get("symmetry_manager")
                                    ->createClient($this, "AcmeDTestDelivery",$params)
                                    ->getStub();       
 
      
        return new \Symfony\Component\HttpFoundation\Response($stub_client);              
        
    } 
      
    
    
    
    // Symmetry client / server role: Bank
    
   
    
     public function symmetryServerBankAction($param)
    {                
      
        $stub_server = $this->get("symmetry_manager")
                       ->createServer($this)
                       ->setServiceParams($param)
                       ->getStub();
       
        
        return new \Symfony\Component\HttpFoundation\Response($stub_server);              
        
    } 
    
    
    
    
    // Symmetry client / server role: Delivery Company
    
    
    
    public function symmetryServerDeliveryCompanyAction($param)
    {                
      
        $stub_server = $this->get("symmetry_manager")
                       ->createServer($this)
                       ->setServiceParams($param)
                       ->getStub();
       
        
        return new \Symfony\Component\HttpFoundation\Response($stub_server);              
        
    } 
    
    
    
    
    public function symmetryDemoAction(){
        
        
          $demo = new SymmetryDemo($this, "http://localhost/Symfony2/web/app_dev.php/");
          $demo->execute();          
        
       
          return $this->redirect($this->generateUrl('MobileSymmetryBundle_symmetryClientCustomer'), 301);
        
    }
    
    
}
