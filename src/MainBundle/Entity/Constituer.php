<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Constituer
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MainBundle\Entity\ConstituerRepository")
 */
class Constituer
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
     * @var \Date
     *
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \Date
     *
     * @ORM\Column(name="dateFin", type="date")
     */
    private $dateFin;
    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\PoliceAssurance")
     */
     private $policeAssurance;
      /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Vehicule")
     */
     private $vehicule;

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
     * Set dateDebut
     *
     * @param \Date $dateDebut
     * @return Constituer
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \Date
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \Date $dateFin
     * @return Constituer
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \Date
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }
    
    
    
    
       /**
     * Set PoliceAssurance
     *
     * @param \MainBundle\Entity\PoliceAssurance $policeAssurance
     * @return Constituer
     */
    public function setPoliceAssurance(\MainBundle\Entity\PoliceAssurance $policeAssurance = null)
    {
        $this->policeAssurance = $policeAssurance;

        return $this;
    }

    /**
     * Get PoliceAssurance
     *
     * @return \MainBundle\Entity\PoliceAssurance 
     */
    public function getPoliceAssurance()
    {
        return $this->policeAssurance;
    }
    
    
    
    
        /**
     * Set Vehicule
     *
     * @param \MainBundle\Entity\Vehicule $vehicule
     * @return Constituer
     */
    public function setVehicule(\MainBundle\Entity\Vehicule $vehicule = null)
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    /**
     * Get Vehicule
     *
     * @return \MainBundle\Entity\Vehicule 
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }
}
