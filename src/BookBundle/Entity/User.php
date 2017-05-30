<?php
// src/BookBundle/Entity/User.php

namespace BookBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
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
     * @var
     * @ORM\OneToOne (targetEntity="CampusManager", inversedBy="user")
     */
    private $campusManager;

    /**
     * @var
     * @ORM\OneToOne (targetEntity="Wilder", inversedBy="user")
     */
    private $wilder;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set campusManager
     *
     * @param \BookBundle\Entity\CampusManager $campusManager
     *
     * @return User
     */
    public function setCampusManager(\BookBundle\Entity\CampusManager $campusManager = null)
    {
        $this->campusManager = $campusManager;

        return $this;
    }

    /**
     * Get campusManager
     *
     * @return \BookBundle\Entity\CampusManager
     */
    public function getCampusManager()
    {
        return $this->campusManager;
    }

    /**
     * Set wilder
     *
     * @param \BookBundle\Entity\wilder $wilder
     *
     * @return User
     */
    public function setWilder(\BookBundle\Entity\wilder $wilder = null)
    {
        $this->wilder = $wilder;

        return $this;
    }

    /**
     * Get wilder
     *
     * @return \BookBundle\Entity\wilder
     */
    public function getWilder()
    {
        return $this->wilder;
    }
}
