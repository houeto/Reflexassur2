<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tarifier
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MainBundle\Entity\TarifierRepository")
 */
class Tarifier
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
     * @var integer
     *
     * @ORM\Column(name="montantBaseGarantie", type="integer")
     */
    private $montantBaseGarantie;
    
    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\PuissanceFiscale")
     */
     private $puissanceFiscale;
     
     /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\ZoneCirculation")
     */
     private $zoneCirculation;
     
     /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\CategorieVehicule")
     */
     private $categorieVehicule;
     
     /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\ClasseConducteur")
     */
     private $classeConducteur;
     
     /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\StatutSocioProfessionnel")
     */
     private $statutSocioProfessionnel;
     
     
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
     * Set montantBaseGarantie
     *
     * @param integer $montantBaseGarantie
     * @return Tarifier
     */
    public function setMontantBaseGarantie($montantBaseGarantie)
    {
        $this->montantBaseGarantie = $montantBaseGarantie;

        return $this;
    }

    /**
     * Get montantBaseGarantie
     *
     * @return integer 
     */
    public function getMontantBaseGarantie()
    {
        return $this->montantBaseGarantie;
    }

    /**
     * Set puissanceFiscale
     *
     * @param \MainBundle\Entity\PuissanceFiscale $puissanceFiscale
     * @return Tarifier
     */
    public function setPuissanceFiscale(\MainBundle\Entity\PuissanceFiscale $puissanceFiscale = null)
    {
        $this->puissanceFiscale = $puissanceFiscale;

        return $this;
    }

    /**
     * Get puissanceFiscale
     *
     * @return \MainBundle\Entity\PuissanceFiscale 
     */
    public function getPuissanceFiscale()
    {
        return $this->puissanceFiscale;
    }

    /**
     * Set zoneCirculation
     *
     * @param \MainBundle\Entity\ZoneCirculation $zoneCirculation
     * @return Tarifier
     */
    public function setZoneCirculation(\MainBundle\Entity\ZoneCirculation $zoneCirculation = null)
    {
        $this->zoneCirculation = $zoneCirculation;

        return $this;
    }

    /**
     * Get zoneCirculation
     *
     * @return \MainBundle\Entity\ZoneCirculation 
     */
    public function getZoneCirculation()
    {
        return $this->zoneCirculation;
    }

    /**
     * Set categorieVehicule
     *
     * @param \MainBundle\Entity\CategorieVehicule $categorieVehicule
     * @return Tarifier
     */
    public function setCategorieVehicule(\MainBundle\Entity\CategorieVehicule $categorieVehicule = null)
    {
        $this->categorieVehicule = $categorieVehicule;

        return $this;
    }

    /**
     * Get categorieVehicule
     *
     * @return \MainBundle\Entity\CategorieVehicule 
     */
    public function getCategorieVehicule()
    {
        return $this->categorieVehicule;
    }

    /**
     * Set classeConducteur
     *
     * @param \MainBundle\Entity\ClasseConducteur $classeConducteur
     * @return Tarifier
     */
    public function setClasseConducteur(\MainBundle\Entity\ClasseConducteur $classeConducteur = null)
    {
        $this->classeConducteur = $classeConducteur;

        return $this;
    }

    /**
     * Get classeConducteur
     *
     * @return \MainBundle\Entity\ClasseConducteur 
     */
    public function getClasseConducteur()
    {
        return $this->classeConducteur;
    }

    /**
     * Set statutSocioProfessionnel
     *
     * @param \MainBundle\Entity\StatutSocioProfessionnel $statutSocioProfessionnel
     * @return Tarifier
     */
    public function setStatutSocioProfessionnel(\MainBundle\Entity\StatutSocioProfessionnel $statutSocioProfessionnel = null)
    {
        $this->statutSocioProfessionnel = $statutSocioProfessionnel;

        return $this;
    }

    /**
     * Get statutSocioProfessionnel
     *
     * @return \MainBundle\Entity\StatutSocioProfessionnel 
     */
    public function getStatutSocioProfessionnel()
    {
        return $this->statutSocioProfessionnel;
    }
}
