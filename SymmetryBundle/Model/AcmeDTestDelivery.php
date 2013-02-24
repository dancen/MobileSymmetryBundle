<?php

namespace Mobile\SymmetryBundle\Model;

/*
 * TEST CLASS SIMULATING A DELIVERY SERVICE
 */
class AcmeDTestDelivery
{
    
    private $id;
    private $customer_code;
    private $delivery_type;
    private $delivery_destination;
    private $delivery_costs;
    private $created_at;

    public function getId()
    {
        return $this->id;
    }

    public function setDeliveryType($deliveryType)
    {
        $this->delivery_type = $deliveryType;
    }

    public function getDeliveryType()
    {
        return $this->delivery_type;
    }

    public function setDeliveryDestination($deliveryDestination)
    {
        $this->delivery_destination = $deliveryDestination;
    }

    public function getDeliveryDestination()
    {
        return $this->delivery_destination;
    }

    public function setDeliveryCosts($deliveryCosts)
    {
        $this->delivery_costs = $deliveryCosts;
    }
    
    public function setCustomerCode($customer_code)
    {
        $this->customer_code = $customer_code;
    }

    public function getDeliveryCosts()
    {
        return $this->delivery_costs;
    }

    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
    public function getDeliveryCode()
    {
        return "ARRSFFR882990";
    }
    
}