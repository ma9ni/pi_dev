<?php

namespace pi\BackEnd\ReclamationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity(repositoryClass="pi\BackEnd\ReclamationBundle\Repository\ReclamationRepository")
 */
class Reclamation
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
     * @var string
     *
     * @ORM\Column(name="sujet", type="string", length=255)
     */
    private $sujet;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="pi\FrontEnd\PetiteurBundle\Entity\OffrePetiteur", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id_offre",referencedColumnName="id",nullable=true,onDelete="CASCADE")
     */
    private $idOffre;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="pi\FrontEnd\FicheDeSoinBundle\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id_membre",referencedColumnName="id",nullable=true,onDelete="CASCADE")
     */
    private $idMembre;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="pi\FrontEnd\AdoptionBundle\Entity\Adoption", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id_adoption",referencedColumnName="id_adoption",nullable=true,onDelete="CASCADE")
     */
    private $idAdoption;


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
     * Set sujet
     *
     * @param string $sujet
     *
     * @return Reclamation
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return string
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Reclamation
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set idOffre
     *
     * @param integer $idOffre
     *
     * @return Reclamation
     */
    public function setIdOffre($idOffre)
    {
        $this->idOffre = $idOffre;

        return $this;
    }

    /**
     * Get idOffre
     *
     * @return int
     */
    public function getIdOffre()
    {
        return $this->idOffre;
    }

    /**
     * Set idMembre
     *
     * @param integer $idMembre
     *
     * @return Reclamation
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
     * Set idAdoption
     *
     * @param integer $idAdoption
     *
     * @return Reclamation
     */
    public function setIdAdoption($idAdoption)
    {
        $this->idAdoption = $idAdoption;

        return $this;
    }

    /**
     * Get idAdoption
     *
     * @return int
     */
    public function getIdAdoption()
    {
        return $this->idAdoption;
    }

}

