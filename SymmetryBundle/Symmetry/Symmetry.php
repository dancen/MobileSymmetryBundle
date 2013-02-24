<?php

namespace Mobile\SymmetryBundle\Symmetry;


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author admin
 */
interface Symmetry {
        
    public static function createClient( $controller, $service_name , $params );
    public static function createServer( $controller );
    
    
}

