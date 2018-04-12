<?php

namespace pi\FrontEnd\DresseurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="rating")
 * @ORM\Entity(repositoryClass="pi\FrontEnd\DresseurBundle\Repository\RatingRepository")
 */
class Rating
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
     * @var integer
     * @ORM\ManyToOne(targetEntity="pi\FrontEnd\FicheDeSoinBundle\Entity\User")
     * @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     */
    private $idUser;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="pi\FrontEnd\FicheDeSoinBundle\Entity\User")
     * @ORM\JoinColumn(name="idMembreCO", referencedColumnName="id")
     */
    private $idMembre;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="pi\FrontEnd\PetiteurBundle\Entity\OffrePetiteur")
     * @ORM\JoinColumn(name="idOffrePet", referencedColumnName="id" ,nullable=true,onDelete="CASCADE")
     */
    private $idOffrePet;

    /**
     * @var integer
     *
     * @ORM\Column(name="note", type="integer" , options={"default":0},nullable=true)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string",nullable=true )
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datenote", type="date" ,nullable=true)
     */
    private $datenote;

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
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Rating
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idMembre
     *
     * @param integer $idMembre
     *
     * @return Rating
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
     * Set note
     *
     * @param integer $note
     *
     * @return Rating
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param string $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @return \DateTime
     */
    public function getDatenote()
    {
        return $this->datenote;
    }

    /**
     * @param \DateTime $datenote
     */
    public function setDatenote($datenote)
    {
        $this->datenote = $datenote;
    }

    /**
     * @return int
     */
    public function getIdOffrePet()
    {
        return $this->idOffrePet;
    }

    /**
     * @param int $idOffrePet
     */
    public function setIdOffrePet($idOffrePet)
    {
        $this->idOffrePet = $idOffrePet;
    }


}

