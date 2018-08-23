<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lister
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MainBundle\Entity\ListerRepository")
 */
class Lister
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="list_oblig", type="boolean")
     */
    private $listOblig;
     /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Compagnie")
     */
     private $compagnie;
      /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\TypeAssurance")
     */
     private $typeAssurance;
      /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Garantie")
     */
     private $garantie;


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
     * Set listOblig
     *
     * @param boolean $listOblig
     * @return Lister
     */
    public function setListOblig($listOblig)
    {
        $this->listOblig = $listOblig;

        return $this;
    }

    /**
     * Get listOblig
     *
     * @return boolean 
     */
    public function getListOblig()
    {
        return $this->listOblig;
    }

    /**
     * Set compagnie
     *
     * @param \MainBundle\Entity\Compagnie $compagnie
     * @return Lister
     */
    public function setCompagnie(\MainBundle\Entity\Compagnie $compagnie = null)
    {
        $this->compagnie = $compagnie;

        return $this;
    }

    /**
     * Get compagnie
     *
     * @return \MainBundle\Entity\Compagnie 
     */
    public function getCompagnie()
    {
        return $this->compagnie;
    }

    /**
     * Set typeAssurance
     *
     * @param \MainBundle\Entity\TypeAssurance $typeAssurance
     * @return Lister
     */
    public function setTypeAssurance(\MainBundle\Entity\TypeAssurance $typeAssurance = null)
    {
        $this->typeAssurance = $typeAssurance;

        return $this;
    }

    /**
     * Get typeAssurance
     *
     * @return \MainBundle\Entity\TypeAssurance 
     */
    public function getTypeAssurance()
    {
        return $this->typeAssurance;
    }

    /**
     * Set garantie
     *
     * @param \MainBundle\Entity\Garantie $garantie
     * @return Lister
     */
    public function setGarantie(\MainBundle\Entity\Garantie $garantie = null)
    {
        $this->garantie = $garantie;

        return $this;
    }

    /**
     * Get garantie
     *
     * @return \MainBundle\Entity\Garantie 
     */
    public function getGarantie()
    {
        return $this->garantie;
    }
}
