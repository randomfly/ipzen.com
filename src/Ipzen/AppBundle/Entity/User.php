<?php

namespace Ipzen\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

// Note : should check out the Doctrine doc for ORM stuff and all

// remember to generate as follows 
// $ php app/console doctrine:generate:entites Simple
// $ php app/console doctrine:schema:create

// And don't forget the database

/**
 * @ORM\Table(name="simple_users")
 * @ORM\Entity(repositoryClass="Ipzen\AppBundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable {
	/**
	 * @ORM\Column(type="interger")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=25)
	private $username;

	/**
	 * @ORM\Column(type="string", length=32, unique=true)
	 */
	private $salt;

	/**
	 * @ORM\Column(type="string", length=40)
	 */
	private $password;

	/**
	 * @ORM\Column(type="string", length=60, unique=true)
	 */
	private $email;

	/**
	 * @ORM\Column(name="is_active", type="boolean")
	 */
	private $isActive;

	public function __construct() {
		$this->isActive = true;
		$this->salt = md5(uniqid(null, true));
	}

	/**
	 * @inheritDoc
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @inheritDoc
	 */
	public function getSalt() {
		return $this->salt;
	}

	/**
	 * @inheritDoc
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @inheritDoc
	 */
	public function getRoles() {
		return array('ROLE_USER');
	}

	/**
	 * @inheritDoc
	 */
	public function eraseCredentials() {

	}

	/**
	 * @inheritDoc
	 */
	public function serialize() {
		return serialize(array($this->id)); // add all other properties such as login, password and stuff
		// return serialize(array(this->id, this->login, this->password))
	}

	/**
	 * @see \Serializable::aunserialize()
	 */
	public function unserialize($serialized) {
		list ($this->$id) = unserialize($serialized);
		// list ($this->$id, $this->$login, $this->password) = unserialize($serialized);
	}

    /**
     * Get id
     *
     * @return \interger 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}
