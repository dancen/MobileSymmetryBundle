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
abstract class SymmetryRemoteErrors  {
        
    const REMOTE_SERVICE_INACTIVE = "The service is not active.";
    const REMOTE_PARAMS_INVALID = "The parameter you sent is not a valid array.";
    const REMOTE_SIGNATURE_INVALID = "The signature of the service is invalid.";
    const REMOTE_OBJECT_INVALID = "The object returned is not a valid RemoteObject.";
    const REMOTE_METHOD_INVALID = "The method you are invoking is not a valid method for the service required.";
    
}

