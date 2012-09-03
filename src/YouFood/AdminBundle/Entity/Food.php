<?php

namespace YouFood\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * YouFood\AdminBundle\Entity\Food
 *
 * @ORM\Table(name="food")
 * @ORM\Entity(repositoryClass="YouFood\AdminBundle\Entity\FoodRepository")
 */
class Food
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
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="YouFood\AdminBundle\Entity\FoodCategory")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="YouFood\AdminBundle\Entity\Menu", mappedBy="foods")
     */
    private $menus;

    public function addMenu(\YouFood\AdminBundle\Entity\Menu $menus)
    {
        $this->menus[] = $menus;
        $menu->addFood($this);
    }

    public function getMenus()
    {
        return $this->menus;
    }


    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(\YouFood\AdminBundle\Entity\FoodCategory $category)
    {
        $this->category = $category;
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

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}