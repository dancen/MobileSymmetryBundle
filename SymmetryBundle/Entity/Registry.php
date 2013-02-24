<?php

namespace Mobile\SymmetryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mobile\SymmetryBundle\Entity\Registry
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Registry
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $service_name
     *
     * @ORM\Column(name="service_name", type="string", length=100)
     */
    private $service_name;

    /**
     * @var string $resource
     *
     * @ORM\Column(name="resource", type="string", length=255)
     */
    private $resource;

    /**
     * @var string $class_name
     *
     * @ORM\Column(name="class_name", type="string", length=100)
     */
    private $class_name;

    /**
     * @var string $method_name
     *
     * @ORM\Column(name="method_name", type="string", length=50)
     */
    private $method_name;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var smallint $active
     *
     * @ORM\Column(name="active", type="smallint")
     */
    private $active;

    /**
     * @var datetime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var datetime $updated_at
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;
    

    public function __construct(){
        $this->created_at = new \Datetime("now");
        $this->updated_at = new \Datetime("now");
    }
        

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set service_name
     *
     * @param string $serviceName
     */
    public function setServiceName($serviceName)
    {
        $this->service_name = $serviceName;
    }

    /**
     * Get service_name
     *
     * @return string 
     */
    public function getServiceName()
    {
        return $this->service_name;
    }

    /**
     * Set resource
     *
     * @param string $resource
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    /**
     * Get resource
     *
     * @return string 
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set class_name
     *
     * @param string $className
     */
    public function setClassName($className)
    {
        $this->class_name = $className;
    }

    /**
     * Get class_name
     *
     * @return string 
     */
    public function getClassName()
    {
        return $this->class_name;
    }

    /**
     * Set method_name
     *
     * @param string $methodName
     */
    public function setMethodName($methodName)
    {
        $this->method_name = $methodName;
    }

    /**
     * Get method_name
     *
     * @return string 
     */
    public function getMethodName()
    {
        return $this->method_name;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set active
     *
     * @param smallint $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * Get active
     *
     * @return smallint 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}