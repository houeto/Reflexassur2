<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicule
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MainBundle\Entity\VehiculeRepository")
 */
class Vehicule
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
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\CategorieVehicule")
     */
     private $categorieVehicule;
      /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Modele")
     */
     private $modele;
     
    /**
     * @var string
     *
     * @ORM\Column(name="Num_Immat", type="string", length=255)
     */
    private $numImmat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Premiere_Mise_Cir", type="datetime")
     */
    private $datePremiereMiseCir;

    /**
     * @var string
     *
     * @ORM\Column(name="Energie", type="string", length=255)
     */
    private $energie;

    /**
     * @var string
     *
     * @ORM\Column(name="Genre", type="string", length=255)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="Carrosserie", type="string", length=255)
     */
    private $carrosserie;

    /**
     * @var string
     *
     * @ORM\Column(name="Nbre_place_hors_Cabine", type="string", length=255)
     */
    private $nbrePlaceHorsCabine;

    /**
     * @var integer
     *
     * @ORM\Column(name="Nbre_places", type="integer")
     */
    private $nbrePlaces;

    /**
     * @var integer
     *
     * @ORM\Column(name="Puissance", type="integer")
     */
    private $puissance;

    /**
     * @var integer
     *
     * @ORM\Column(name="Charge_utile", type="integer")
     */
    private $chargeUtile;

    /**
     * @var integer
     *
     * @ORM\Column(name="Ptac", type="integer")
     */
    private $ptac;

    /**
     * @var integer
     *
     * @ORM\Column(name="Pv", type="integer")
     */
    private $pv;

    /**
     * @var integer
     *
     * @ORM\Column(name="Puissance_reelle", type="integer")
     */
    private $puissanceReelle;

    /**
     * @var string
     *
     * @ORM\Column(name="Num_serie", type="string", length=255)
     */
    private $numSerie;

    /**
     * @var string
     *
     * @ORM\Column(name="Num_chassis", type="string", length=255)
     */
    private $numChassis;

    /**
     * @var integer
     *
     * @ORM\Column(name="Valneu", type="integer")
     */
    private $valneu;

    /**
     * @var integer
     *
     * @ORM\Column(name="Valven", type="integer")
     */
    private $valven;

    /**
     * @var string
     *
     * @ORM\Column(name="Lieu_Garage", type="string", length=255)
     */
    private $lieuGarage;

    /**
     * @var string
     *
     * @ORM\Column(name="Gpsgsm", type="string", length=255)
     */
    private $gpsgsm;

    /**
     * @var string
     *
     * @ORM\Column(name="Tarif", type="string", length=255)
     */
    private $tarif;

    /**
     * @var string
     *
     * @ORM\Column(name="Condhab", type="string", length=255)
     */
    private $condhab;


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
     * Set numImmat
     *
     * @param string $numImmat
     * @return Vehicule
     */
    public function setNumImmat($numImmat)
    {
        $this->numImmat = $numImmat;

        return $this;
    }

    /**
     * Get numImmat
     *
     * @return string 
     */
    public function getNumImmat()
    {
        return $this->numImmat;
    }

    /**
     * Set datePremiereMiseCir
     *
     * @param \DateTime $datePremiereMiseCir
     * @return Vehicule
     */
    public function setDatePremiereMiseCir($datePremiereMiseCir)
    {
        $this->datePremiereMiseCir = $datePremiereMiseCir;

        return $this;
    }

    /**
     * Get datePremiereMiseCir
     *
     * @return \DateTime 
     */
    public function getDatePremiereMiseCir()
    {
        return $this->datePremiereMiseCir;
    }

    /**
     * Set energie
     *
     * @param string $energie
     * @return Vehicule
     */
    public function setEnergie($energie)
    {
        $this->energie = $energie;

        return $this;
    }

    /**
     * Get energie
     *
     * @return string 
     */
    public function getEnergie()
    {
        return $this->energie;
    }

    /**
     * Set genre
     *
     * @param string $genre
     * @return Vehicule
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set carrosserie
     *
     * @param string $carrosserie
     * @return Vehicule
     */
    public function setCarrosserie($carrosserie)
    {
        $this->carrosserie = $carrosserie;

        return $this;
    }

    /**
     * Get carrosserie
     *
     * @return string 
     */
    public function getCarrosserie()
    {
        return $this->carrosserie;
    }

    /**
     * Set nbrePlaceHorsCabine
     *
     * @param string $nbrePlaceHorsCabine
     * @return Vehicule
     */
    public function setNbrePlaceHorsCabine($nbrePlaceHorsCabine)
    {
        $this->nbrePlaceHorsCabine = $nbrePlaceHorsCabine;

        return $this;
    }

    /**
     * Get nbrePlaceHorsCabine
     *
     * @return string 
     */
    public function getNbrePlaceHorsCabine()
    {
        return $this->nbrePlaceHorsCabine;
    }

    /**
     * Set nbrePlaces
     *
     * @param integer $nbrePlaces
     * @return Vehicule
     */
    public function setNbrePlaces($nbrePlaces)
    {
        $this->nbrePlaces = $nbrePlaces;

        return $this;
    }

    /**
     * Get nbrePlaces
     *
     * @return integer 
     */
    public function getNbrePlaces()
    {
        return $this->nbrePlaces;
    }

    /**
     * Set puissance
     *
     * @param string $puissance
     * @return Vehicule
     */
    public function setPuissance($puissance)
    {
        $this->puissance = $puissance;

        return $this;
    }

    /**
     * Get puissance
     *
     * @return string 
     */
    public function getPuissance()
    {
        return $this->puissance;
    }

    /**
     * Set chargeUtile
     *
     * @param string $chargeUtile
     * @return Vehicule
     */
    public function setChargeUtile($chargeUtile)
    {
        $this->chargeUtile = $chargeUtile;

        return $this;
    }

    /**
     * Get chargeUtile
     *
     * @return string 
     */
    public function getChargeUtile()
    {
        return $this->chargeUtile;
    }

    /**
     * Set ptac
     *
     * @param string $ptac
     * @return Vehicule
     */
    public function setPtac($ptac)
    {
        $this->ptac = $ptac;

        return $this;
    }

    /**
     * Get ptac
     *
     * @return string 
     */
    public function getPtac()
    {
        return $this->ptac;
    }

    /**
     * Set pv
     *
     * @param integer $pv
     * @return Vehicule
     */
    public function setPv($pv)
    {
        $this->pv = $pv;

        return $this;
    }

    /**
     * Get pv
     *
     * @return integer 
     */
    public function getPv()
    {
        return $this->pv;
    }

    /**
     * Set puissanceReelle
     *
     * @param string $puissanceReelle
     * @return Vehicule
     */
    public function setPuissanceReelle($puissanceReelle)
    {
        $this->puissanceReelle = $puissanceReelle;

        return $this;
    }

    /**
     * Get puissanceReelle
     *
     * @return string 
     */
    public function getPuissanceReelle()
    {
        return $this->puissanceReelle;
    }

    /**
     * Set numSerie
     *
     * @param string $numSerie
     * @return Vehicule
     */
    public function setNumSerie($numSerie)
    {
        $this->numSerie = $numSerie;

        return $this;
    }

    /**
     * Get numSerie
     *
     * @return string 
     */
    public function getNumSerie()
    {
        return $this->numSerie;
    }

    /**
     * Set numChassis
     *
     * @param string $numChassis
     * @return Vehicule
     */
    public function setNumChassis($numChassis)
    {
        $this->numChassis = $numChassis;

        return $this;
    }

    /**
     * Get numChassis
     *
     * @return string 
     */
    public function getNumChassis()
    {
        return $this->numChassis;
    }

    /**
     * Set valneu
     *
     * @param string $valneu
     * @return Vehicule
     */
    public function setValneu($valneu)
    {
        $this->valneu = $valneu;

        return $this;
    }

    /**
     * Get valneu
     *
     * @return string 
     */
    public function getValneu()
    {
        return $this->valneu;
    }

    /**
     * Set valven
     *
     * @param string $valven
     * @return Vehicule
     */
    public function setValven($valven)
    {
        $this->valven = $valven;

        return $this;
    }

    /**
     * Get valven
     *
     * @return string 
     */
    public function getValven()
    {
        return $this->valven;
    }

    /**
     * Set lieuGarage
     *
     * @param string $lieuGarage
     * @return Vehicule
     */
    public function setLieuGarage($lieuGarage)
    {
        $this->lieuGarage = $lieuGarage;

        return $this;
    }

    /**
     * Get lieuGarage
     *
     * @return string 
     */
    public function getLieuGarage()
    {
        return $this->lieuGarage;
    }

    /**
     * Set gpsgsm
     *
     * @param string $gpsgsm
     * @return Vehicule
     */
    public function setGpsgsm($gpsgsm)
    {
        $this->gpsgsm = $gpsgsm;

        return $this;
    }

    /**
     * Get gpsgsm
     *
     * @return string 
     */
    public function getGpsgsm()
    {
        return $this->gpsgsm;
    }

    /**
     * Set tarif
     *
     * @param string $tarif
     * @return Vehicule
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return string 
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set condhab
     *
     * @param string $condhab
     * @return Vehicule
     */
    public function setCondhab($condhab)
    {
        $this->condhab = $condhab;

        return $this;
    }

    /**
     * Get condhab
     *
     * @return string 
     */
    public function getCondhab()
    {
        return $this->condhab;
    }

    /**
     * Set categorieVehicule
     *
     * @param \MainBundle\Entity\CategorieVehicule $categorieVehicule
     * @return Vehicule
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
     * Set modele
     *
     * @param \MainBundle\Entity\Modele $modele
     * @return Vehicule
     */
    public function setModele(\MainBundle\Entity\Modele $modele = null)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return \MainBundle\Entity\Modele 
     */
    public function getModele()
    {
        return $this->modele;
    }
}
