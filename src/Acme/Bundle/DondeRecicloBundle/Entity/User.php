<?php

// src/Acme/Bundle/DondeRecicloBundle/Entity/User.php
namespace Acme\Bundle\DondeRecicloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="dondereciclo.user")
 * @ORM\HasLifecycleCallbacks
 */

use Doctrine\Common\Collections\ArrayCollection;

class User
{
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;
	
	/**
	 * @ORM\Column(type="string",name="fname")
	 */
	protected $fname;

	/**
	 * @ORM\Column(type="string",name="lname")
	 */
	protected $lname;
	
	/**
	 * @ORM\Column(type="string",name="email")
	 */
	protected $email;
	
	/**
	 * @ORM\Column(type="string", name="username")
	 */
	protected $username;
	
	/**
	 * @ORM\Column(type="string", name="password")
	 */
	protected $password;
	
	/**
	 * @ORM\Column(type="datetime",name="created_at")
	 */
	protected $createdAt;
	
	/**
	 * @ORM\Column(type="datetime",name="modified_at")
	 */
	protected $modifiedAt;
	
	/**
	 * @ORM\OneToMany(targetEntity="Point", mappedBy="user")
	 */
	protected $points = null;
	
	public function __construct($fname = null, $lname = null, $email = null, $username= null, $password = null)
	{
		$this->points = new ArrayCollection();
		$this->fname = $fname;
		$this->lname = $lname;
		$this->email = $email;
		$this->username = $username;
		$this->password = sha1($password); 	
	}
	
	// Getters and setters
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getFname()
	{
		return $this->fname;
	}
	
	public function setFname($fname)
	{
		$this->fname = $fname;
	}
	
	public function getLname()
	{
		return $this->lname;
	}
	
	public function setLname($lname)
	{
		$this->lname = $lname;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	public function getUsername()
	{
		return $this->username;
	}
	
	public function setUsername($username)
	{
		$this->username = $username;
	}
	
	public function setPassword($password)
	{
		$this->password = sha1($password);
	}
	
	public function getPassword()
	{
		return $this->password;
	}
	
	public function getPoints()
	{
		return $this->points;
	}
	
	public function addPoint($point)
	{
		$this->Points[] = $point;
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
