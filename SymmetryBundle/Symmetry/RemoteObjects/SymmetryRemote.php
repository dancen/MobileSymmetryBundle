<?php

namespace Mobile\SymmetryBundle\Symmetry\RemoteObjects;


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author admin
 */
interface SymmetryRemote {
    
    public function setRemoteParameters($params);
    public function invoke();
    
    
}

