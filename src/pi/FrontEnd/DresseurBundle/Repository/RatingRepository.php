<?php

namespace pi\FrontEnd\DresseurBundle\Repository;

/**
 * RatingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RatingRepository extends \Doctrine\ORM\EntityRepository
{

    public function moyenneNote($id)
    {
        return $this->createQueryBuilder('r')
            ->select("avg(r.note) as noteuser")
            ->where('r.idUser=:idmembre')
            ->setParameter('idmembre',$id)
            ->groupBy('r.idUser')
            ->getQuery()
            ->getResult();

    }
    
    public function affCom($id)
    {
        return $this->createQueryBuilder('r')
            ->select("(r.commentaire) as comm, (r.idMembre) as hoscam")
            ->where('r.idUser=:idmembre')
            ->setParameter('idmembre',$id)
            ->getQuery()
            ->getResult();

    }
}
