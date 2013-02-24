<?php

namespace Mobile\SymmetryBundle\Symmetry;

use Mobile\SymmetryBundle\Symmetry\Symmetry;
use Mobile\SymmetryBundle\Symmetry\RemoteObjects\SymmetryClient;
use Mobile\SymmetryBundle\Symmetry\RemoteObjects\SymmetryServer;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author admin
 */
class SymmetryFactory implements Symmetry {
        
    public static function createClient( $controller, $service_name , $params ){
                    return SymmetryClient::getInstance($controller)->setServiceName( $service_name , $params );
    }
    
    public static function createServer( $controller ){
                    return SymmetryServer::getInstance( $controller );
    }
    
    
}

