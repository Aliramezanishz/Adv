<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\commentRepository")
 */
class Comment {

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
     * @ORM\Column(name="Name", type="string", length=255)
     * 
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;

     /**
     * @ORM\ManyToOne(targetEntity="Adv", inversedBy="comments")
     * @ORM\JoinColumn(name="adv_id", referencedColumnName="id")
     */
    private $Adv;
    

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
     *
     * @return Comment
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set comment
     *
     * @param string $comment
     *
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set adv
     *
     * @param \AppBundle\Entity\Adv $adv
     *
     * @return Comment
     */
    public function setAdv(\AppBundle\Entity\Adv $adv = null)
    {
        $this->Adv = $adv;

        return $this;
    }

    /**
     * Get adv
     *
     * @return \AppBundle\Entity\Adv
     */
    public function getAdv()
    {
        return $this->Adv;
    }
}
