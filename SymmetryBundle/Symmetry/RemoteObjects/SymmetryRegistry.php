<?php

namespace Mobile\SymmetryBundle\Symmetry\RemoteObjects;

use Mobile\SymmetryBundle\Symmetry\RemoteObjects\Calculator;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author admin
 */
class SymmetryRegistry {
        
    public static function getRegistry($controller = null) {
        
        $em = $controller->getDoctrine()->getEntityManager();
        $repository =  $em->getRepository('MobileSymmetryBundle:Registry');       
        $query = $repository->createQueryBuilder('p')->orderBy('p.id', 'ASC')->getQuery();       
        $registry_array = array();
        
        foreach ($query->getResult() as $result) {
            
            $service_name = $result->getServiceName();
            $class = "\\Mobile\\SymmetryBundle\\Symmetry\\RemoteObjects\\".$result->getClassName();
                        
            $registry_array[$service_name] = array( "servicename" => $result->getServiceName(),
                                                     "url" => $result->getResource(),
                                                     "cls" => new $class(),
                                                     "method" => $result->getMethodName(),
                                                     "description" => $result->getMethodName(),
                                                     "active" => $result->getActive());
        }
        
        return  $registry_array;
        
    }  
    
    
}

