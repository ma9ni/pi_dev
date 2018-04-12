<?php

namespace pi\FrontEnd\FicheDeSoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraint as Assert ;

/**
 * animal
 *
 * @ORM\Table(name="animal")
 * @ORM\Entity(repositoryClass="pi\FrontEnd\FicheDeSoinBundle\Repository\animalRepository")
 */
class animal
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_membre", referencedColumnName="id")
     */
    private $idMembre;



    /**
     * @var string
     *
     * @ORM\Column(name="nomproprietaire", type="string", length=255)
     */
    private $nomproprietaire;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255)
     */
    private $sexe;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Datedenaissance", type="date")
     */
    private $datedenaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=255 )
     */
    private $race;
    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_membre", referencedColumnName="id")
     */
    private $idMembre;

    /**
<<<<<<< HEAD
     * @ORM\Column(name="image", type="string")
     */
    public $image;

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


=======
     * @var int
     * @ORM\ManyToOne(targetEntity="pi\FrontEnd\FicheDeSoinBundle\Entity\User")
     * @ORM\JoinColumn(name="id_membre",referencedColumnName="id",onDelete="CASCADE")
     */
>>>>>>> aecd55095bfd9a8ec3d097f9c8ac1652a7938404


    private $id_membre;
    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
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
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param string $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return \DateTime
     */
    public function getDatedenaissance()
    {
        return $this->datedenaissance;
    }

    /**
     * @param \DateTime $datedenaissance
     */
    public function setDatedenaissance($datedenaissance)
    {
        $this->datedenaissance = $datedenaissance;
    }

    /**
     * @return string
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
<<<<<<< HEAD
     * @param string $race
     */
    public function setRace($race)
    {
        $this->race = $race;
    }

//    /**
//     * @ORM\Column(type="string")
//     *
//     * @Assert\NotBlank(message="Please, upload the image.")
//     * @Assert\File(mimeTypes={ "application/pdf" })
//     */
//    private $image;


=======
     * @return int
     */
    public function getIdMembre()
    {
        return $this->id_membre;
    }

    /**
     * @param int $id_membre
     */
    public function setIdMembre($id_membre)
    {
        $this->id_membre = $id_membre;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
        return $this->idMembre;
    }


    /**
     * Generates the magic method
     *
     */
    public function __toString(){
        // to show the name of the Category in the select
        return $this->nom;
        // to show the id of the Category in the select
        // return $this->id;
    }
>>>>>>> aecd55095bfd9a8ec3d097f9c8ac1652a7938404


}

