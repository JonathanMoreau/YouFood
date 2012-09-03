<?php

namespace YouFood\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="youOrderFood")
 */
class YouOrderFood
{
    /**
     * @var integer $youorder
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="YouFood\AdminBundle\Entity\YouOrder")
     */
    private $youOrder;

    /**
     * @var integer $food
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="YouFood\AdminBundle\Entity\Food")
     */
    private $food;

    /**
     * @var integer $quantity
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;


    public function getYouOrder()
    {
        return $this->youOrder;
    }
    public function setYouOrder(\YouFood\AdminBundle\Entity\YouOrder $youOrder)
    {
        $this->youOrder = $youOrder;
    }

    public function getFood()
    {
        return $this->food;
    }
    public function setFood(\YouFood\AdminBundle\Entity\Food $food)
    {
        $this->food = $food;
    }
    
    /**
     * Set status
     *
     * @param integer $status
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}