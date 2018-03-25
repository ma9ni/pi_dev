<?php

namespace pi\FrontEnd\FicheDeDressageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * f_dressage
 *
 * @ORM\Table(name="f_dressage")
 * @ORM\Entity(repositoryClass="pi\FrontEnd\FicheDeDressageBundle\Repository\f_dressageRepository")
 */
class f_dressage
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
     * @ORM\ManyToOne(targetEntity="pi\FrontEnd\FicheDeSoinBundle\Entity\User")
     * @ORM\JoinColumn(name="id_membre", referencedColumnName="id")
     */
    private $idMembre;

    /**
     * @var int
     * @ORM\Column(name="displine", type="integer")
     */
    private $displine;

    /**
     * @var int
     *
     * @ORM\Column(name="obeissance", type="integer")
     */
    private $obeissance;

    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="string", length=255)
     */
    private $specialite;

    /**
     * @var int
     *
     * @ORM\Column(name="accompagnement", type="integer")
     */
    private $accompagnement;

    /**
     * @var int
     *
     * @ORM\Column(name="interception", type="integer")
     */
    private $interception;

    /**
     * @var float
     *
     * @ORM\Column(name="noteTotale", type="float")
     */
    private $noteTotale;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date")
     */
    private $dateFin;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="pi\FrontEnd\FicheDeSoinBundle\Entity\animal")
     * @ORM\JoinColumn(name="id_animal",referencedColumnName="id")
     */
    private $id_animal;


    /**
     * @var integer
     * @ORM\Column(name="etat", type="integer", options={"default":1})
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
     * @return f_dressage
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
     * Set displine
     *
     * @param integer $displine
     *
     * @return f_dressage
     */
    public function setDispline($displine)
    {
        $this->displine = $displine;

        return $this;
    }

    /**
     * Get displine
     *
     * @return int
     */
    public function getDispline()
    {
        return $this->displine;
    }

    /**
     * Set obeissance
     *
     * @param integer $obeissance
     *
     * @return f_dressage
     */
    public function setObeissance($obeissance)
    {
        $this->obeissance = $obeissance;

        return $this;
    }

    /**
     * Get obeissance
     *
     * @return int
     */
    public function getObeissance()
    {
        return $this->obeissance;
    }

    /**
     * Set specialite
     *
     * @param string $specialite
     *
     * @return f_dressage
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * Get specialite
     *
     * @return string
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * Set accompagnement
     *
     * @param integer $accompagnement
     *
     * @return f_dressage
     */
    public function setAccompagnement($accompagnement)
    {
        $this->accompagnement = $accompagnement;

        return $this;
    }

    /**
     * Get accompagnement
     *
     * @return int
     */
    public function getAccompagnement()
    {
        return $this->accompagnement;
    }

    /**
     * Set interception
     *
     * @param integer $interception
     *
     * @return f_dressage
     */
    public function setInterception($interception)
    {
        $this->interception = $interception;

        return $this;
    }

    /**
     * Get interception
     *
     * @return int
     */
    public function getInterception()
    {
        return $this->interception;
    }

    /**
     * Set noteTotale
     *
     * @param float $noteTotale
     *
     * @return f_dressage
     */
    public function setNoteTotale($noteTotale)
    {
        $this->noteTotale = $noteTotale;

        return $this;
    }

    /**
     * Get noteTotale
     *
     * @return float
     */
    public function getNoteTotale()
    {
        return $this->noteTotale;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return f_dressage
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return f_dressage
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return f_dressage
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @return int
     */
    public function getIdAnimal()
    {
        return $this->id_animal;
    }

    /**
     * @param int $id_animal
     */
    public function setIdAnimal($id_animal)
    {
        $this->id_animal = $id_animal;
    }



}
