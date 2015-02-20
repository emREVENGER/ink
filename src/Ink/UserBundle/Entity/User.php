<?php
/**
 * Created by PhpStorm.
 * User: yilmaz_e
 * Date: 08/02/15
 * Time: 21:39
 */
namespace Ink\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */

    protected $firstname_user;

    /**
     * @ORM\Column(type="string")
     */

    protected $lastname_user;

    /**
     * @ORM\Column(type="string")
     */

    protected $birthday_user;


    /**
     * @ORM\Column(type="string")
     */

    protected $city_user;

    /**
     * @ORM\Column(type="string")
     */

    protected $street_user;


   /**
    * @ORM\Column(type="string")
    */

    protected $postalcode_user;


   /**
    * @ORM\Column(type="string")
    */

    protected $description_user;


   /**
    * @ORM\Column(type="integer")
    */

    protected $id_status;


    public function __construct()
    {
        parent::__construct();
        // your own logic
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
     * Set city_user
     *
     * @param string $cityUser
     * @return User
     */
    public function setCityUser($cityUser)
    {
        $this->city_user = $cityUser;

        return $this;
    }

    /**
     * Get city_user
     *
     * @return string 
     */
    public function getCityUser()
    {
        return $this->city_user;
    }

    /**
     * Set firstname_user
     *
     * @param string $firstnameUser
     * @return User
     */
    public function setFirstnameUser($firstnameUser)
    {
        $this->firstname_user = $firstnameUser;

        return $this;
    }

    /**
     * Get firstname_user
     *
     * @return string 
     */
    public function getFirstnameUser()
    {
        return $this->firstname_user;
    }

    /**
     * Set lastname_user
     *
     * @param string $lastnameUser
     * @return User
     */
    public function setLastnameUser($lastnameUser)
    {
        $this->lastname_user = $lastnameUser;

        return $this;
    }

    /**
     * Get lastname_user
     *
     * @return string 
     */
    public function getLastnameUser()
    {
        return $this->lastname_user;
    }

    /**
     * Set birthday_user
     *
     * @param string $birthdayUser
     * @return User
     */
    public function setBirthdayUser($birthdayUser)
    {
        $this->birthday_user = $birthdayUser;

        return $this;
    }

    /**
     * Get birthday_user
     *
     * @return string 
     */
    public function getBirthdayUser()
    {
        return $this->birthday_user;
    }

    /**
     * Set street_user
     *
     * @param string $streetUser
     * @return User
     */
    public function setStreetUser($streetUser)
    {
        $this->street_user = $streetUser;

        return $this;
    }

    /**
     * Get street_user
     *
     * @return string 
     */
    public function getStreetUser()
    {
        return $this->street_user;
    }

    /**
     * Set postalcode_user
     *
     * @param string $postalcodeUser
     * @return User
     */
    public function setPostalcodeUser($postalcodeUser)
    {
        $this->postalcode_user = $postalcodeUser;

        return $this;
    }

    /**
     * Get postalcode_user
     *
     * @return string 
     */
    public function getPostalcodeUser()
    {
        return $this->postalcode_user;
    }

    /**
     * Set description_user
     *
     * @param string $descriptionUser
     * @return User
     */
    public function setDescriptionUser($descriptionUser)
    {
        $this->description_user = $descriptionUser;

        return $this;
    }

    /**
     * Get description_user
     *
     * @return string 
     */
    public function getDescriptionUser()
    {
        return $this->description_user;
    }

    /**
     * Set id_status
     *
     * @param integer $idStatus
     * @return User
     */
    public function setIdStatus($idStatus)
    {
        $this->id_status = $idStatus;

        return $this;
    }

    /**
     * Get id_status
     *
     * @return integer 
     */
    public function getIdStatus()
    {
        return $this->id_status;
    }
}
