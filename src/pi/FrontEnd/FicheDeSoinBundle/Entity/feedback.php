<?php

namespace pi\FrontEnd\FicheDeSoinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * feedback
 *
 * @ORM\Table(name="feedback")
 * @ORM\Entity(repositoryClass="pi\FrontEnd\FicheDeSoinBundle\Repository\feedbackRepository")
 */
class feedback
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
     * @ORM\Column(name="like_number", type="integer")
     */
    private $likeNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_membre", referencedColumnName="id")
     */
    private $idMembre;



    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="animal")
     * @ORM\JoinColumn(name="id_animal", referencedColumnName="id", onDelete="CASCADE")
     */
    private $idanimal;

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
     * @return int
     */
    public function getIdanimal()
    {
        return $this->idanimal;
    }

    /**
     * @param int $idanimal
     */
    public function setIdanimal($idanimal)
    {
        $this->idanimal = $idanimal;
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
     * Set likeNumber.
     *
     * @param int $likeNumber
     *
     * @return feedback
     */
    public function setLikeNumber($likeNumber)
    {
        $this->likeNumber = $likeNumber;

        return $this;
    }

    /**
     * Get likeNumber.
     *
     * @return int
     */
    public function getLikeNumber()
    {
        return $this->likeNumber;
    }

    /**
     * Set comment.
     *
     * @param string $comment
     *
     * @return feedback
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
}
