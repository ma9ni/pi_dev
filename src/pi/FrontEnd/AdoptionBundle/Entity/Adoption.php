<?php

namespace pi\FrontEnd\AdoptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adoption
 *
 * @ORM\Table(name="adoption", indexes={@ORM\Index(name="FK_membreAdoption", columns={"id_membre"})})
 * @ORM\Entity(repositoryClass="pi\FrontEnd\AdoptionBundle\Repository\AdoptionRepository")
 */
class Adoption
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_adoption", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAdoption;
    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="pi\FrontEnd\FicheDeSoinBundle\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id_membre",referencedColumnName="id",onDelete="CASCADE")
     */

    private $idMembre;

    /**
     * @var string
     * @ORM\Column(name="type", type="string", length=11, nullable=true)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAnnonce", type="date", nullable=true)
     */
    private $dateannonce;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=50, nullable=false)
     */
    private $lieu;

    /**
     * @var integer
     *
     * @ORM\Column(name="etatAdoption", type="integer", nullable=true)
     */
    private $etatadoption;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="pi\FrontEnd\FicheDeSoinBundle\Entity\animal", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="id_animal",referencedColumnName="id",nullable=false,onDelete="CASCADE")
     */
    private $idAnimal;

    /**
     * @return int
     */
    public function getIdAdoption()
    {
        return $this->idAdoption;
    }

    /**
     * @param int $idAdoption
     */
    public function setIdAdoption($idAdoption)
    {
        $this->idAdoption = $idAdoption;
    }

    /**
     * @return int
     */
    public function getIdMembre()
    {
        return $this->idMembre;
    }

    /**
     * @param int $idMembre
     */
    public function setIdMembre($idMembre)
    {
        $this->idMembre = $idMembre;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return \DateTime
     */
    public function getDateannonce()
    {
        return $this->dateannonce;
    }

    /**
     * @param \DateTime $dateannonce
     */
    public function setDateannonce($dateannonce)
    {
        $this->dateannonce = $dateannonce;
    }

    /**
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param string $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return int
     */
    public function getEtatadoption()
    {
        return $this->etatadoption;
    }

    /**
     * @param int $etatadoption
     */
    public function setEtatadoption($etatadoption)
    {
        $this->etatadoption = $etatadoption;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getIdAnimal()
    {
        return $this->idAnimal;
    }

    /**
     * @param int $idAnimal
     */
    public function setIdAnimal($idAnimal)
    {
        $this->idAnimal = $idAnimal;
    }


}
