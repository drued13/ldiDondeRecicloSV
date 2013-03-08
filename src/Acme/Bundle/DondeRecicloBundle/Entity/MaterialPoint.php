<?php

namespace Acme\Bundle\DondeRecicloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="dondereciclo.material_point")
 * @ORM\HasLifecycleCallbacks
 */

use Doctrine\Common\Collections\ArrayCollection;

class MaterialPoint
{
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer",name="id")
	 * @ORM\GeneratedValue
	 */
	protected $id;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Point", inversedBy="materialPoints")
	 * @ORM\JoinColumn(name="point_id", referencedColumnName="id")
	 */
	protected $point;
	
	/**
	 * @ORM\ManyToOne(targetEntity="MaterialType", inversedBy="materialType")
	 * @ORM\JoinColumn(name="material_type_id", referencedColumnName="id")
	 */
	protected $materialType;
	
	/**
	 * @ORM\Column(type="datetime",name="created_at")
	 */
	protected $createdAt;
	
	/**
	 * @ORM\Column(type="datetime",name="modified_at")
	 */
	protected $modifiedAt;
	
	/**
	 * @ORM\Column(type="float",name="price_per_pound")
	 */
	protected $pricePerPound;
	
	// Getters and Setters
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getPoint()
	{
		return $this->point;
	}
	
	public function setPoint($point)
	{
		$this->point = $point;
	}
	
	public function getMaterialType()
	{
		return $this->materialType;
	}
	
	public function setMaterialType($materialType)
	{
		$this->materialType = $materialType;
	}
	
	public function getCreatedAt()
	{
		return $this->createdAt;
	}
	
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}
	
	public function getModifiedAt()
	{
		return $this->modifiedAt;
	}
	
	public function setModifiedAt($modifiedAt)
	{
		$this->modifiedAt = $modifiedAt;
	}
	
	public function getPricePerPound()
	{
		return $this->pricePerPound;
	}
	
	public function setPricePerPound($pricePerPound)
	{
		$this->pricePerPound = $pricePerPound;
	}
	
	/**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
    	$this->setCreatedAt(new DateTime());
    	$this->setModifiedAt(new DateTime());
    }
    
    /**
     * @ORM\PreUpdate
     */
	public function preUpdate()
	{
		$this->setModifiedAt(new DateTime());
	}
}