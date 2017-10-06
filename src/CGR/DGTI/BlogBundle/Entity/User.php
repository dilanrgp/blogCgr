<?php

namespace CGR\DGTI\BlogBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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

//    public function __construct()
//    {
//        parent::__construct();
//        // your own logic
//    }
    
    /**
     * @ORM\ManyToMany(targetEntity="CGR\DGTI\BlogBundle\Entity\Group")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;
    
    /**
     * One User has Many News.
     * @ORM\OneToMany(targetEntity="News", mappedBy="usuarioInsert")
     */
    private $user_insert;
    
    /**
     * One User has Many News.
     * @ORM\OneToMany(targetEntity="News", mappedBy="usuarioUpdate")
     */
    private $user_update;

    public function __construct() {
        parent::__construct();
        $this->user_update = new ArrayCollection();
        $this->user_insert = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->username;
    }
    
     
    
}