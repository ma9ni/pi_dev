<?php

namespace pi\FrontEnd\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="pi\FrontEnd\FaqBundle\Repository\QuestionRepository")
 */
class Question
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
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var int
     *
     * @ORM\OneToOne(targetEntity="pi\FrontEnd\FaqBundle\Entity\Reponse")
     * @ORM\JoinColumn(name="idReponse", referencedColumnName="id")
     */
    private $idReponse;

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
     * Set question
     *
     * @param string $question
     *
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set idReponse
     *
     * @param integer $idReponse
     *
     * @return Question
     */
    public function setIdReponse($idReponse)
    {
        $this->idReponse = $idReponse;

        return $this;
    }

    /**
     * Get idReponse
     *
     * @return int
     */
    public function getIdReponse()
    {
        return $this->idReponse;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Question
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

    public function __construct()
    {
        $this->etat=0;
    }
}
