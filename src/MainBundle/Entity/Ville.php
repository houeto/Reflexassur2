<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MainBundle\Entity\VilleRepository")
 */
class Ville
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;
    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\ZoneCirculation")
     */
     private $zoneCirculation;


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
     * Set nom
     *
     * @param string $nom
     * @return Ville
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

   

    /**
     * Set zoneCirculation
     *
     * @param \MainBundle\Entity\ZoneCirculation $zoneCirculation
     * @return Ville
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
}
