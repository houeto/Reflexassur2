<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TauxAssuranceTemporaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MainBundle\Entity\TauxAssuranceTemporaireRepository")
 */
class TauxAssuranceTemporaire
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
     * @ORM\Column(name="bornInf", type="integer")
     */
    private $bornInf;

    /**
     * @var integer
     *
     * @ORM\Column(name="bornSup", type="integer")
     */
    private $bornSup;

    /**
     * @var float
     *
     * @ORM\Column(name="tauxDouble", type="float")
     */
    private $tauxDouble;


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
     * Set bornInf
     *
     * @param integer $bornInf
     * @return TauxAssuranceTemporaire
     */
    public function setBornInf($bornInf)
    {
        $this->bornInf = $bornInf;

        return $this;
    }

    /**
     * Get bornInf
     *
     * @return integer 
     */
    public function getBornInf()
    {
        return $this->bornInf;
    }

    /**
     * Set bornSup
     *
     * @param integer $bornSup
     * @return TauxAssuranceTemporaire
     */
    public function setBornSup($bornSup)
    {
        $this->bornSup = $bornSup;

        return $this;
    }

    /**
     * Get bornSup
     *
     * @return integer 
     */
    public function getBornSup()
    {
        return $this->bornSup;
    }

    /**
     * Set tauxDouble
     *
     * @param float $tauxDouble
     * @return TauxAssuranceTemporaire
     */
    public function setTauxDouble($tauxDouble)
    {
        $this->tauxDouble = $tauxDouble;

        return $this;
    }

    /**
     * Get tauxDouble
     *
     * @return float 
     */
    public function getTauxDouble()
    {
        return $this->tauxDouble;
    }
}
