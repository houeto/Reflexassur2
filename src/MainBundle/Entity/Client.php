<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Client
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MainBundle\Entity\ClientRepository")
 */
class Client
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

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
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="prof", type="string", length=255)
     */
    private $prof;

    /**
     * @var string
     *
     * @ORM\Column(name="catsosprof", type="string", length=255)
     */
    private $catsosprof;

    /**
     * @var string
     *
     * @ORM\Column(name="ifu", type="string", length=255)
     */
    private $ifu;
     /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\TarifGroupement")
     */
     private $tarifGroupement;
      /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\CategorieClient")
     */
     private $categorieClient;


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
     * Set titre
     *
     * @param string $titre
     * @return Client
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Client
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
     * Set adresse
     *
     * @param string $adresse
     * @return Client
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
     * @return Client
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
     * Set fax
     *
     * @param string $fax
     * @return Client
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Client
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set prof
     *
     * @param string $prof
     * @return Client
     */
    public function setProf($prof)
    {
        $this->prof = $prof;

        return $this;
    }

    /**
     * Get prof
     *
     * @return string 
     */
    public function getProf()
    {
        return $this->prof;
    }

    /**
     * Set catsosprof
     *
     * @param string $catsosprof
     * @return Client
     */
    public function setCatsosprof($catsosprof)
    {
        $this->catsosprof = $catsosprof;

        return $this;
    }

    /**
     * Get catsosprof
     *
     * @return string 
     */
    public function getCatsosprof()
    {
        return $this->catsosprof;
    }

    /**
     * Set ifu
     *
     * @param string $ifu
     * @return Client
     */
    public function setIfu($ifu)
    {
        $this->ifu = $ifu;

        return $this;
    }

    /**
     * Get ifu
     *
     * @return string 
     */
    public function getIfu()
    {
        return $this->ifu;
    }

    /**
     * Set tarifGroupement
     *
     * @param \MainBundle\Entity\TarifGroupement $tarifGroupement
     * @return TarifGroupement
     */
    public function setTarifGroupement(\MainBundle\Entity\TarifGroupement $tarifGroupement = null)
    {
        $this->tarifGroupement = $tarifGroupement;

        return $this;
    }

    /**
     * Get tarifGroupement
     *
     * @return \MainBundle\Entity\TarifGroupement 
     */
    public function getTarifGroupement()
    {
        return $this->tarifGroupement;
    }

    /**
     * Set categorieClient
     *
     * @param \MainBundle\Entity\CategorieClient $categorieClient
     * @return Client
     */
    public function setCategorieClient(\MainBundle\Entity\CategorieClient $categorieClient = null)
    {
        $this->categorieClient = $categorieClient;

        return $this;
    }

    /**
     * Get categorieClient
     *
     * @return \MainBundle\Entity\CategorieClient 
     */
    public function getCategorieClient()
    {
        return $this->categorieClient;
    }
}
