<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TarifFlotte
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MainBundle\Entity\TarifFlotteRepository")
 */
class TarifFlotte
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
     * @ORM\Column(name="Borne_inf", type="integer")
     */
    private $borneInf;

    /**
     * @var integer
     *
     * @ORM\Column(name="Borne_sup", type="integer")
     */
    private $borneSup;

    /**
     * @var integer
     *
     * @ORM\Column(name="taux", type="integer")
     */
    private $taux;


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
     * Set borneInf
     *
     * @param integer $borneInf
     * @return TarifFlotte
     */
    public function setBorneInf($borneInf)
    {
        $this->borneInf = $borneInf;

        return $this;
    }

    /**
     * Get borneInf
     *
     * @return integer 
     */
    public function getBorneInf()
    {
        return $this->borneInf;
    }

    /**
     * Set borneSup
     *
     * @param integer $borneSup
     * @return TarifFlotte
     */
    public function setBorneSup($borneSup)
    {
        $this->borneSup = $borneSup;

        return $this;
    }

    /**
     * Get borneSup
     *
     * @return integer 
     */
    public function getBorneSup()
    {
        return $this->borneSup;
    }

    /**
     * Set taux
     *
     * @param integer $taux
     * @return TarifFlotte
     */
    public function setTaux($taux)
    {
        $this->taux = $taux;

        return $this;
    }

    /**
     * Get taux
     *
     * @return integer 
     */
    public function getTaux()
    {
        return $this->taux;
    }
}
