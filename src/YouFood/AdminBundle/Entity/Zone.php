<?php

namespace YouFood\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * YouFood\AdminBundle\Entity\Zone
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="YouFood\AdminBundle\Entity\ZoneRepository")
 */
class Zone
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="YouFood\AdminBundle\Entity\User", inversedBy="zones")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="YouFood\AdminBundle\Entity\Board", mappedBy="zone")
     */
    private $boards;

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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(\YouFood\AdminBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    public function __toString()
    {
        return strval($this->id);
    }

    public function getBoards()
    {
        return $this->boards;
    }

    public function addBoard(\YouFood\AdminBundle\Entity\Board $board)
    {
        $this->boards[] = $boards;
    }
}