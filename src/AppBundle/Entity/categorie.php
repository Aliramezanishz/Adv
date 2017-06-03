<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * categories
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\categorieRepository")
 */
class categorie {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */

    /**
     * @var string
     *
     * @ORM\Column(name="Cat", type="string", length=255)
     */
    private $Cat;

   
    
         /**
     * @ORM\OneToMany(targetEntity="Adv", mappedBy="categorie")
     */
    private $advs;

    public function __toString() {
        return $Cat;
    }
  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->advs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set cat
     *
     * @param string $cat
     *
     * @return categorie
     */
    public function setCat($cat)
    {
        $this->Cat = $cat;

        return $this;
    }

    /**
     * Get cat
     *
     * @return string
     */
    public function getCat()
    {
        return $this->Cat;
    }

    /**
     * Add adv
     *
     * @param \AppBundle\Entity\Adv $adv
     *
     * @return categorie
     */
    public function addAdv(\AppBundle\Entity\Adv $adv)
    {
        $this->advs[] = $adv;

        return $this;
    }

    /**
     * Remove adv
     *
     * @param \AppBundle\Entity\Adv $adv
     */
    public function removeAdv(\AppBundle\Entity\Adv $adv)
    {
        $this->advs->removeElement($adv);
    }

    /**
     * Get advs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdvs()
    {
        return $this->advs;
    }
}
