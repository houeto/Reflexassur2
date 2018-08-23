<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TarifGroupement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MainBundle\Entity\TarifGroupementRepository")
 */
class TarifGroupement
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
     * @var string
     *
     * @ORM\Column(name="taux", type="decimal")
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
     * Set bornInf
     *
     * @param integer $bornInf
     * @return TarifGroupement
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
     * @return TarifGroupement
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
     * Set taux
     *
     * @param string $taux
     * @return TarifGroupement
     */
    public function setTaux($taux)
    {
        $this->taux = $taux;

        return $this;
    }

    /**
     * Get taux
     *
     * @return string 
     */
    public function getTaux()
    {
        return $this->taux;
    }
}
