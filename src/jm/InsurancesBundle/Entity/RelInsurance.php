<?php
/**
 * Created by PhpStorm.
 * User: jumu
 * Date: 08.10.17
 * Time: 13:57
 */

namespace jm\InsurancesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Class RelInsurance
 * @package jm\InsurancesBundle\Entity
 * @ORM\Entity(repositoryClass="RelInsuranceRepository")
 * @ORM\Table(name="rel_insurance")
 */
class RelInsurance {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Many Insurances have One ategory.
     * @ORM\ManyToOne(targetEntity="RelCategory", inversedBy="insurances")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\Column(type="string")
     */
    private $name; //Versicherungsname

    /**
     * @ORM\Column(type="string")
     */
    private $provider; //Anbieter

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description; //Beschreibung
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $street; //Straße/Hausnummer
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $location; //Ort
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zip; //PLZ
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $email;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $tel;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $opening_time;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notice;

    public function __toString()
    {
        return (string) $this->name;
    }
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return mixed
     */
    public function getOpeningTime()
    {
        return $this->opening_time;
    }

    /**
     * @param mixed $opening_time
     */
    public function setOpeningTime($opening_time)
    {
        $this->opening_time = $opening_time;
    }

    /**
     * @return mixed
     */
    public function getNotice()
    {
        return $this->notice;
    }

    /**
     * @param mixed $notice
     */
    public function setNotice($notice)
    {
        $this->notice = $notice;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    } //Bemerkungen
}
