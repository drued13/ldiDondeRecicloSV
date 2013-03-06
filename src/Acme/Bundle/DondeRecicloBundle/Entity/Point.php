<?php

namespace Acme\Bundle\DondeRecicloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dondereciclo.point")
 * @ORM\HasLifecycleCallbacks
 */

use Doctrine\Common\Collections\ArrayCollection;

class Point {

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", name="id")
	 * @ORM\GeneratedValue
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", name="place_name")
	 */
	protected $placeName;

	/**
	 * @ORM\Column(type="string", name="contact_email")
	 */
	protected $contactEmail;

	/**
	 * @ORM\Column(type="string", name="contact_phone")
	 */
	protected $contact_phone;

	/**
	 * @ORM\Column(type="string", name="address")
	 */
	protected $address;

	/**
	 * @ORM\Column(type="string", name="web_site")
	 */
	protected $website;

	/**
	 * @ORM\Column(type="string", name="country_geoname_id")
	 */
	protected $countryGeonameId;

	/**
	 * @ORM\Column(type="string", name="state_geoname_id")
	 */
	protected $stateGeonameId;

	/**
	 * @ORM\Column(type="string", name="city_geoname_id")
	 */
	protected $cityGeonameId;
	
	/**
	 * @ORM\Column(type="decimal", name="lat")
	 */
	protected $lat;
	
	/**
	 * @ORM\Column(type="decimal", name="lng")
	 */
	protected $lng;

	/**
	 * @ORM\OneToMany(targetEntity="MaterialPoint", mappedBy="point")
	 */
	protected $materialPoints = null;
	
	/**
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="user")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
	protected $user;
	
	/**
	 * @ORM\Column(type="datetime",name="created_at")
	 */
	protected $createdAt;
	
	/**
	 * @ORM\Column(type="datetime",name="modified_at")
	 */
	protected $modifiedAt;

	function __construct() {
		$this->materialPoints = new ArrayCollection();
	}

	public function getId() {
		return $this->id;
	}

	public function getPlaceName() {
		return $this->placeName;
	}

	public function setPlaceName($placeName) {
		$this->placeName = $placeName;
	}

	public function getContactEmail() {
		return $this->contactEmail;
	}

	public function setContactEmail($contactEmail) {
		$this->contactEmail = $contactEmail;
	}

	public function getContactPhone() {
		return $this->contact_phone;
	}

	public function setContactPhone($contact_phone) {
		$this->contact_phone = $contact_phone;
	}

	public function getAddress() {
		return $this->address;
	}

	public function setAddress($address) {
		$this->address = $address;
	}

	public function getWebsite() {
		return $this->website;
	}

	public function setWebsite($website) {
		$this->website = $website;
	}

	public function getCountryGeonameId() {
		return $this->countryGeonameId;
	}

	public function setCountryGeonameId($countryGeonameId) {
		$this->countryGeonameId = $countryGeonameId;
	}

	public function getStateGeonameId() {
		return $this->stateGeonameId;
	}

	public function setStateGeonameId($stateGeonameId) {
		$this->stateGeonameId = $stateGeonameId;
	}

	public function getCityGeonameId() {
		return $this->cityGeonameId;
	}

	public function setCityGeonameId($cityGeonameId) {
		$this->cityGeonameId = $cityGeonameId;
	}
	
	public function getLat() {
		return $this->lat;
	}
	
	public function setLat($lat) {
		$this->lat = $lat;
	}
	
	public function getLng() {
		return $this->lng;
	}
	
	public function setLng($lng) {
		$this->lng = $lng;
	}

	public function getUser() {
		return $this->user;
	}

	public function setUser($user) {
		$this->user = $user;
	}

	public function getMaterialPoints() {
		return $this->materialPoints;
	}
	
	public function addMaterialPoint($materialpoint)
	{
		//array_push($this->materialPoints, $materialpoint);
		$this->materialPoints[] = $materialpoint;
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
	
	/**
	 * @PrePersist
	 */
	public function prePersist()
	{
		$this->setCreatedAt(new DateTime());
		$this->setModifiedAt(new DateTime());
	}
	
	/**
	 * @PreUpdate
	 */
	public function preUpdate()
	{
		$this->setModifiedAt(new DateTime());
	}
}
