<?php

namespace pi\FrontEnd\AnimaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * sosDisparition
 *
 * @ORM\Table(name="sos_disparition")
 * @ORM\Entity(repositoryClass="pi\FrontEnd\AnimaleBundle\Repository\sosDisparitionRepository")
 */
class sosDisparition
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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }




    /**
     * @var string
     *
     * @ORM\Column(name="nomproprietaire", type="string", length=255)
     */
    private $nomproprietaire;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }



    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=255)
     */
    private $race;


    /**
     * @var int
     *
     * @ORM\Column(name="num_tel", type="integer", length=255)
     */
    private $num_tel;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(name="image", type="string")
     */
    public $image;


    /**
     * @return string
     */


    public function getNomproprietaire()
    {
        return $this->nomproprietaire;
    }

    /**
     * @param string $nomproprietaire
     */
    public function setNomproprietaire($nomproprietaire)
    {
        $this->nomproprietaire = $nomproprietaire;
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
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @param string $race
     */
    public function setRace($race)
    {
        $this->race = $race;
    }

    /**
     * @return int
     */
    public function getNumTel()
    {
        return $this->num_tel;
    }

    /**
     * @param int $num_tel
     */
    public function setNumTel($num_tel)
    {
        $this->num_tel = $num_tel;
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
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }




}
