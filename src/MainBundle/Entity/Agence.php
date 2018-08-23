<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agence
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Agence
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
     * @var string
     *
     * @ORM\Column(name="mon", type="string", length=255)
     */
    private $mon;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;
       /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Compagnie")
     */
     private $compagnie;


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
     * Set mon
     *
     * @param string $mon
     * @return Agence
     */
    public function setMon($mon)
    {
        $this->mon = $mon;

        return $this;
    }

    /**
     * Get mon
     *
     * @return string 
     */
    public function getMon()
    {
        return $this->mon;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Agence
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Agence
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set compagnie
     *
     * @param \MainBundle\Entity\Compagnie $compagnie
     * @return Agence
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
}
