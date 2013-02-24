MobileSymmetryBundle by Daniele Centamore
=================================

About
-----
MobileSymmetryBundle is a toolkit that allows multiple instances Symfony2, installed on different machines and connected in network, to communicate between themselves in order to distribute the processing capacity and to offer distributed services by remote method invokation. The toolkit uses a security manager that generates a signature of the requested service. It provides to Symmetry an effective and basic security system. In the logic of a toolkit a Supplier offers a service that different Clients may require through the invocation of class methods resident on the Supplier server through a Proxy class, the same Supplier may in turn call other Suppliers to meet the required service becoming itself a Client. The name of the toolkit "Symmetry" reflects the synthesis of architecture. Symmetry classes on client and server so that clients can invoke only classes and methods present in mirror and present on both the Client and the Server systems. 

Installation requirements
-------------------------
You should be able to get Symfony 2.1 up and running with curl library installed before you can use the MobileSymmetryBundle toolkit. You need to install also the MobileLoggingBundle.

Installation instructions
-------------------------
Installation is straightforward, add the following lines to your deps file:

```
[MobileLoggingBundle]
    git=https://github.com/dancen/MobileLoggingBundle.git
    version=1.1.0

[MobileSymmetryBundle]
    git=https://github.com/dancen/MobileSymmetryBundle.git
    version=1.1.0
```


Add to your AppKernel.php file:

```
new Mobile\LoggingBundle\MobileLoggingBundle(),
new Mobile\SymmetryBundle\MobileSymmetryBundle(),
```

To use the toolkit you need to generate and share between client and server two classes:

An operative class under the 'model' directory:

e.g: Mobile\SymmetryBundle\Model\AcmeBTestSupplier.php

A proxy class under the 'RemoteObjects' directory :

e.g: Mobile\SymmetryBundle\Symmetry\RemoteObjects\AcmeBTestSupplierProxy.php

The service must be registered in the Registry repository using the registry web interface providing service parameters.

e.g: http://localhost/Symfony2/web/app_dev.php/symmetry/registry/

```
1) e.g.: AcmeBTestSupplier [The service name is the unique name of the service used by clients to call the remote resource. You cannot change it but it is supplied from the service supplier.] 
```
```
2) e.g.: http://localhost/Symfony2/web/app_dev.php/symmetry/server/supplier/ [The URI of the service. The symmetry remote method invocation need a valid resource in order to execute the remote calling. It is usually communicated by the service supplier.] 
```
```
3) e.g.: AcmeBTestSupplierProxy [The remote class name of the service you need to call. The name Symmetry comes from the concept by having the identical class on local and remote machine. So you instance the real class from your local machine but execute methods on the remote machine. If the class->method you are calling not exists on the remote machine you can get an REMOTE_OBJECT_INVALID or REMOTE_METHOD_INVALID error.] 
```
```
4) e.g.: getOrderId [The remote method name of the service you need to call. The method return always a RemoteObject object. If the class->method you are calling not exists on the remote machine you can get an REMOTE_OBJECT_INVALID or REMOTE_METHOD_INVALID error.] 
```
```
5) e.g.: product order id, return integer [The description of the service supplied. Usually the supplier describe all useful info about the parameters needed and the type returned.] 
```
```
6) e.g.: 1 or 0 [The flag can be managed by the supplier in order to activate or inactivate the service. If the service you are calling is not active (0) on the remote machine you can get an REMOTE_SERVICE_INACTIVE error. You must manage the exception in your code.] 
```

to see Symmetry in action open the DefaultController
a demo is available you can run it just setting your server path in the symmetryDemo action.

e.g: http://localhost/Symfony2/web/app_dev.php/symmetry/demo


```


Contact
-------
Daniele Centamore (info@danielecentamore.com)

Download
--------
You can also clone the project with Git by running:

```
$ git clone git://github.com/dancen/MobileSymmetryBundle
```

