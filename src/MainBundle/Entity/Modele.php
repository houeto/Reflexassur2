<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modele
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MainBundle\Entity\ModeleRepository")
 */
class Modele
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
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Marque")
     */
     private $marque;
/**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nomComplet", type="text", nullable=true)
     */
    private $nomComplet;
    
    
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
     * Set libelle
     *
     * @param string $libelle
     * @return Modele
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set marque
     *
     * @param \MainBundle\Entity\Marque $marque
     * @return Modele
     */
    public function setMarque(\MainBundle\Entity\Marque $marque = null)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return \MainBundle\Entity\Marque 
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set nomComplet
     *
     * @param string $nomComplet
     * @return Modele
     */
    public function setNomComplet($nomComplet)
    {
        $this->nomComplet = $nomComplet;

        return $this;
    }

    /**
     * Get nomComplet
     *
     * @return string 
     */
    public function getNomComplet()
    {
        return $this->nomComplet;
    }
}
