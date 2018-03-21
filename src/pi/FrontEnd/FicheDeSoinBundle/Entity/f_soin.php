<?php

namespace pi\FrontEnd\FicheDeSoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * f_soin
 *
 * @ORM\Table(name="f_soin")
 * @ORM\Entity(repositoryClass="pi\FrontEnd\FicheDeSoinBundle\Repository\f_soinRepository")
 */
class f_soin
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_membre", type="integer")
     */
    private $idMembre;

    /**
     * @var string
     *
     * @ORM\Column(name="observation", type="string", length=255)
     */
    private $observation;

    /**
     * @var string
     *
     * @ORM\Column(name="medicament", type="string", length=255)
     */
    private $medicament;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="date")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="prochainRDV", type="date")
     */
    private $prochainRDV;

    /**
     * @var int
     *
     * @ORM\Column(name="id_animal", type="integer")
     */
    private $idAnimal;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idMembre
     *
     * @param integer $idMembre
     *
     * @return f_soin
     */
    public function setIdMembre($idMembre)
    {
        $this->idMembre = $idMembre;

        return $this;
    }

    /**
     * Get idMembre
     *
     * @return int
     */
    public function getIdMembre()
    {
        return $this->idMembre;
    }

    /**
     * Set observation
     *
     * @param string $observation
     *
     * @return f_soin
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return string
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * Set medicament
     *
     * @param string $medicament
     *
     * @return f_soin
     */
    public function setMedicament($medicament)
    {
        $this->medicament = $medicament;

        return $this;
    }

    /**
     * Get medicament
     *
     * @return string
     */
    public function getMedicament()
    {
        return $this->medicament;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return f_soin
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set prochainRDV
     *
     * @param \DateTime $prochainRDV
     *
     * @return f_soin
     */
    public function setProchainRDV($prochainRDV)
    {
        $this->prochainRDV = $prochainRDV;

        return $this;
    }

    /**
     * Get prochainRDV
     *
     * @return \DateTime
     */
    public function getProchainRDV()
    {
        return $this->prochainRDV;
    }

    /**
     * Set idAnimal
     *
     * @param integer $idAnimal
     *
     * @return f_soin
     */
    public function setIdAnimal($idAnimal)
    {
        $this->idAnimal = $idAnimal;

        return $this;
    }

    /**
     * Get idAnimal
     *
     * @return int
     */
    public function getIdAnimal()
    {
        return $this->idAnimal;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return f_soin
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }
}

