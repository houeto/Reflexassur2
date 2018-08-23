<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PoliceAssurance
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MainBundle\Entity\PoliceAssuranceRepository")
 */
class PoliceAssurance
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
     * @ORM\Column(name="numAven", type="integer")
     */
    private $numAven;

    /**
     * @var string
     *
     * @ORM\Column(name="numAssur", type="string", length=255)
     */
    private $numAssur;

    /**
     * @var string
     *
     * @ORM\Column(name="nomAssur", type="string", length=255)
     */
    private $nomAssur;

    /**
     * @var string
     *
     * @ORM\Column(name="AdressAssur", type="string", length=255)
     */
    private $adressAssur;

    /**
     * @var string
     *
     * @ORM\Column(name="CatAssur", type="string", length=255)
     */
    private $catAssur;

    /**
     * @var string
     *
     * @ORM\Column(name="mouvAssur", type="string", length=255)
     */
    private $mouvAssur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateEffAssur", type="datetime")
     */
    private $dateEffAssur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateExpAssur", type="datetime")
     */
    private $dateExpAssur;

    /**
     * @var integer
     *
     * @ORM\Column(name="dureeAssur", type="integer")
     */
    private $dureeAssur;
     /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Agence")
     */
     private $agence;
      /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\TypePoliceAssurance")
     */
     private $typePoliceAssurance;
      /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Client")
     */
     private $client;


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
     * Set numAven
     *
     * @param integer $numAven
     * @return PoliceAssurance
     */
    public function setNumAven($numAven)
    {
        $this->numAven = $numAven;

        return $this;
    }

    /**
     * Get numAven
     *
     * @return integer 
     */
    public function getNumAven()
    {
        return $this->numAven;
    }

    /**
     * Set numAssur
     *
     * @param string $numAssur
     * @return PoliceAssurance
     */
    public function setNumAssur($numAssur)
    {
        $this->numAssur = $numAssur;

        return $this;
    }

    /**
     * Get numAssur
     *
     * @return string 
     */
    public function getNumAssur()
    {
        return $this->numAssur;
    }

    /**
     * Set nomAssur
     *
     * @param string $nomAssur
     * @return PoliceAssurance
     */
    public function setNomAssur($nomAssur)
    {
        $this->nomAssur = $nomAssur;

        return $this;
    }

    /**
     * Get nomAssur
     *
     * @return string 
     */
    public function getNomAssur()
    {
        return $this->nomAssur;
    }

    /**
     * Set adressAssur
     *
     * @param string $adressAssur
     * @return PoliceAssurance
     */
    public function setAdressAssur($adressAssur)
    {
        $this->adressAssur = $adressAssur;

        return $this;
    }

    /**
     * Get adressAssur
     *
     * @return string 
     */
    public function getAdressAssur()
    {
        return $this->adressAssur;
    }

    /**
     * Set catAssur
     *
     * @param string $catAssur
     * @return PoliceAssurance
     */
    public function setCatAssur($catAssur)
    {
        $this->catAssur = $catAssur;

        return $this;
    }

    /**
     * Get catAssur
     *
     * @return string 
     */
    public function getCatAssur()
    {
        return $this->catAssur;
    }

    /**
     * Set mouvAssur
     *
     * @param string $mouvAssur
     * @return PoliceAssurance
     */
    public function setMouvAssur($mouvAssur)
    {
        $this->mouvAssur = $mouvAssur;

        return $this;
    }

    /**
     * Get mouvAssur
     *
     * @return string 
     */
    public function getMouvAssur()
    {
        return $this->mouvAssur;
    }

    /**
     * Set dateEffAssur
     *
     * @param \DateTime $dateEffAssur
     * @return PoliceAssurance
     */
    public function setDateEffAssur($dateEffAssur)
    {
        $this->dateEffAssur = $dateEffAssur;

        return $this;
    }

    /**
     * Get dateEffAssur
     *
     * @return \DateTime 
     */
    public function getDateEffAssur()
    {
        return $this->dateEffAssur;
    }

    /**
     * Set dateExpAssur
     *
     * @param \DateTime $dateExpAssur
     * @return PoliceAssurance
     */
    public function setDateExpAssur($dateExpAssur)
    {
        $this->dateExpAssur = $dateExpAssur;

        return $this;
    }

    /**
     * Get dateExpAssur
     *
     * @return \DateTime 
     */
    public function getDateExpAssur()
    {
        return $this->dateExpAssur;
    }

    /**
     * Set dureeAssur
     *
     * @param integer $dureeAssur
     * @return PoliceAssurance
     */
    public function setDureeAssur($dureeAssur)
    {
        $this->dureeAssur = $dureeAssur;

        return $this;
    }

    /**
     * Get dureeAssur
     *
     * @return integer 
     */
    public function getDureeAssur()
    {
        return $this->dureeAssur;
    }

    /**
     * Set agence
     *
     * @param \MainBundle\Entity\Agence $agence
     * @return PoliceAssurance
     */
    public function setAgence(\MainBundle\Entity\Agence $agence = null)
    {
        $this->agence = $agence;

        return $this;
    }

    /**
     * Get agence
     *
     * @return \MainBundle\Entity\Agence 
     */
    public function getAgence()
    {
        return $this->agence;
    }

    /**
     * Set typePoliceAssurance
     *
     * @param \MainBundle\Entity\TypePoliceAssurance $typePoliceAssurance
     * @return PoliceAssurance
     */
    public function setTypePoliceAssurance(\MainBundle\Entity\TypePoliceAssurance $typePoliceAssurance = null)
    {
        $this->typePoliceAssurance = $typePoliceAssurance;

        return $this;
    }

    /**
     * Get typePoliceAssurance
     *
     * @return \MainBundle\Entity\TypePoliceAssurance 
     */
    public function getTypePoliceAssurance()
    {
        return $this->typePoliceAssurance;
    }

    /**
     * Set client
     *
     * @param \MainBundle\Entity\Client $client
     * @return PoliceAssurance
     */
    public function setClient(\MainBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \MainBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }
}
