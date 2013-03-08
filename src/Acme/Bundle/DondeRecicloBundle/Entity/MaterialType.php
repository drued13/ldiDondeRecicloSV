<?php

namespace Acme\Bundle\DondeRecicloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="dondereciclo.material_type")
 */

use Doctrine\Common\Collections\ArrayCollection;

class MaterialType {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", name="id")
	 * @ORM\GeneratedValue()
	 */
	protected $id = null;

	/**
	 * @ORM\Column(type="string", name="name")
	 */
	protected $name;

	/**
	 * @ORM\OneToMany(targetEntity="MaterialPoint", mappedBy="materialType")
	 */
	protected $materialTypes = null;

	public function __construct($name = null) {
		$this->materialTypes = new ArrayCollection();
		$this->name = $name;
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getMaterialTypes() {
		return $this->materialTypes;
	}

	public function addMaterialType($materialType) {
		//array_push($this->$materialTypes, $materialType)
		$this->materialTypes[] = $materialType; 
	}

}
