<?php

namespace pi\FrontEnd\CouncoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * participation
 *
 * @ORM\Table(name="participation")
 * @ORM\Entity(repositoryClass="pi\FrontEnd\CouncoursBundle\Repository\participationRepository")
 */
class participation
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
     * @ORM\ManyToOne(targetEntity="pi\FrontEnd\FicheDeSoinBundle\Entity\animal")
     * @ORM\JoinColumn(name="idAnimal", referencedColumnName="id")
     */
    private $idAnimal;
    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="pi\FrontEnd\CouncoursBundle\Entity\concours")
     * @ORM\JoinColumn(name="idConcour", referencedColumnName="id")
     */
    private $idConcour;
    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer")
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

    /**
     * @return int
     */
    public function getIdConcour()
    {
        return $this->idConcour;
    }

    /**
     * @param int $idConcour
     */
    public function setIdConcour($idConcour)
    {
        $this->idConcour = $idConcour;
    }

    /**
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param int $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

}

