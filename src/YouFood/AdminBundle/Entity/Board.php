<?php

namespace YouFood\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * YouFood\AdminBundle\Entity\Board
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="YouFood\AdminBundle\Entity\BoardRepository")
 */
class Board
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
     * @var float $number
     *
     * @ORM\Column(name="number", type="integer", length=10)
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="YouFood\AdminBundle\Entity\Zone")
     */
    private $zone;


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
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    public function getZone()
    {
        return $this->zone;
    }

    public function setZone(\YouFood\AdminBundle\Entity\Zone $zone)
    {
        $this->zone = $zone;
    }
}