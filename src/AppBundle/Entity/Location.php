<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LocationRepository")
 */
class Location
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Loc", type="string", length=255)
     */
    private $loc;

    
  
    
        /**
     * @ORM\OneToMany(targetEntity="Adv", mappedBy="Location")
     */
    private $advs;
    

   
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
     * Set loc
     *
     * @param string $loc
     *
     * @return Location
     */
    public function setLoc($loc)
    {
        $this->loc = $loc;

        return $this;
    }

    /**
     * Get loc
     *
     * @return string
     */
    public function getLoc()
    {
        return $this->loc;
    }

    /**
     * Add adv
     *
     * @param \AppBundle\Entity\Adv $adv
     *
     * @return Location
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
