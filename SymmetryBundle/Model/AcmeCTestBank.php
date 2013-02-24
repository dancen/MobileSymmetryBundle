<?php

namespace Mobile\SymmetryBundle\Model;

/*
 * TEST CLASS SIMULATING A BANK AGENT
 */


class AcmeCTestBank
{

    private $id;
    private $bank_customer_ref;
    private $merchant_ref;
    private $credit_available;
    private $debit;
    private $blocked;
    private $created_at;

    public function getId()
    {
        return $this->id;
    }

    public function setBankCustomerRef($bankCustomerRef)
    {
        $this->bank_customer_ref = $bankCustomerRef;
    }

    
    
    public function getCreditAvailable()
    {
        return $this->credit_available;
    }

   
    public function getBlocked()
    {
        return $this->blocked;
    }

    
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
    
    public function getAuthorization(){
        return "true";
    }
    
    
    public function setDebit($debit)
    {
        $this->debit = $debit;
    }
    
    public function setMerchantRef($merchant_ref)
    {
        $this->merchant_ref = $merchant_ref;
    }
    
}