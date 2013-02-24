<?php

namespace Mobile\SymmetryBundle\Symmetry\RemoteObjects;
 

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Acme
 *
 * @author admin
 */

class CalculatorProxy  {
    
       
    public function __construct(){} 
  
    public static function getProduct($params){
      return $params[0] * $params[1];
    }
    
    public static function getDivision($params){
      return $params[0] / $params[1];
    }
    
    public static function getSum($params){
      return $params[0] + $params[1];
    }
    
    public static function getSubtraction($params){
      return $params[0] - $params[1];
    }
    
    public static function getAverage($params){
        $sum = 0;
        for($i=0;$i<count($params);$i++){
              $sum = $sum + $params[$i];
        }
        
        $average = $sum / count($params);
      return $average;
    }
    
    
       
}