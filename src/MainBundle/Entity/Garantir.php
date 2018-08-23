<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Garantir
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MainBundle\Entity\GarantirRepository")
 */
class Garantir
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
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\PoliceAssurance")
     */
     private $policeAssurance;


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
     * Set compagnie
     *
     * @param \MainBundle\Entity\Compagnie $compagnie
     * @return Garantir
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
     * @return Garantir
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
     * @return Garantir
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

    /**
     * Set policeAssurance
     *
     * @param \MainBundle\Entity\PoliceAssurance $policeAssurance
     * @return Garantir
     */
    public function setPoliceAssurance(\MainBundle\Entity\PoliceAssurance $policeAssurance = null)
    {
        $this->policeAssurance = $policeAssurance;

        return $this;
    }

    /**
     * Get policeAssurance
     *
     * @return \MainBundle\Entity\PoliceAssurance 
     */
    public function getPoliceAssurance()
    {
        return $this->policeAssurance;
    }
}
