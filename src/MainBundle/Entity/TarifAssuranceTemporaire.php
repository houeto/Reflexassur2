<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TarifAssuranceTemporaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MainBundle\Entity\TarifAssuranceTemporaireRepository")
 */
class TarifAssuranceTemporaire
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateVig", type="datetime")
     */
    private $dateVig;
     /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\TauxAssuranceTemporaire")
     */
     private $tauxAssuranceTemporaire;


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
     * Set dateVig
     *
     * @param \DateTime $dateVig
     * @return TarifAssuranceTemporaire
     */
    public function setDateVig($dateVig)
    {
        $this->dateVig = $dateVig;

        return $this;
    }

    /**
     * Get dateVig
     *
     * @return \DateTime 
     */
    public function getDateVig()
    {
        return $this->dateVig;
    }

    /**
     * Set tauxAssuranceTemporaire
     *
     * @param \MainBundle\Entity\TauxAssuranceTemporaire $tauxAssuranceTemporaire
     * @return TarifAssuranceTemporaire
     */
    public function setTauxAssuranceTemporaire(\MainBundle\Entity\TauxAssuranceTemporaire $tauxAssuranceTemporaire = null)
    {
        $this->tauxAssuranceTemporaire = $tauxAssuranceTemporaire;

        return $this;
    }

    /**
     * Get tauxAssuranceTemporaire
     *
     * @return \MainBundle\Entity\TauxAssuranceTemporaire 
     */
    public function getTauxAssuranceTemporaire()
    {
        return $this->tauxAssuranceTemporaire;
    }
}
