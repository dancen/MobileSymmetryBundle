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
abstract class SymmetryRemoteObject {
        
     protected abstract function initializeSymmetrySecurityManager();
     public abstract function getStub();
    
}

