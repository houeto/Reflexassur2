<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieVehicule
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MainBundle\Entity\CategorieVehiculeRepository")
 */
class CategorieVehicule
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
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\TarifFlotte")
     */
     private $tarifFlotte;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Cat_flotte", type="boolean")
     */
    private $catFlotte;


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
     * @return CategorieVehicule
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
     * Set catFlotte
     *
     * @param boolean $catFlotte
     * @return CategorieVehicule
     */
    public function setCatFlotte($catFlotte)
    {
        $this->catFlotte = $catFlotte;

        return $this;
    }

    /**
     * Get catFlotte
     *
     * @return boolean 
     */
    public function getCatFlotte()
    {
        return $this->catFlotte;
    }

    /**
     * Set tarifFlotte
     *
     * @param \MainBundle\Entity\TarifFlotte $tarifFlotte
     * @return CategorieVehicule
     */
    public function setTarifFlotte(\MainBundle\Entity\TarifFlotte $tarifFlotte = null)
    {
        $this->tarifFlotte = $tarifFlotte;

        return $this;
    }

    /**
     * Get tarifFlotte
     *
     * @return \MainBundle\Entity\TarifFlotte 
     */
    public function getTarifFlotte()
    {
        return $this->tarifFlotte;
    }
}
