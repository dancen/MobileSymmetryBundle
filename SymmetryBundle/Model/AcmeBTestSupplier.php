<?php

namespace Mobile\SymmetryBundle\Model;


/*
 * TEST CLASS SIMULATING A SUPPLIER
 */


class AcmeBTestSupplier
{
    
    private $id;
    private $product_code;
    private $quantity;
    private $customer_id;
    private $delivery;
    private $created_at;
    
    public function getId()
    {
        return $this->id;
    }

    public function setProductCode($productCode)
    {
        $this->product_code = $productCode;
    }
    
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;
    }
    
    public function setCustomerId($customer)
    {
        $this->customer_id = $customer;
    }    

    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }
    
    public function getOrderId()
    {
       
        return "ORDER ID: ".rand(0,100000);
    }

    
}