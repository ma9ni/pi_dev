<?php

namespace pi\FrontEnd\FicheDeSoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=255 )
     */
    private $race;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="pi\FrontEnd\FicheDeSoinBundle\Entity\User")
     * @ORM\JoinColumn(name="id_membre",referencedColumnName="id",onDelete="CASCADE")
     */


    private $id_membre;
    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;
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
     * Set nom
     *
     * @param string $nom
     *
     * @return animal
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set race
     *
     * @param string $race
     *
     * @return animal
     */
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return string
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
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


}

