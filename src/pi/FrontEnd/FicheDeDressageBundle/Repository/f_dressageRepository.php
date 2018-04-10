<?php
/**
 * Created by PhpStorm.
 * User: pc asus
 * Date: 25/03/2018
 * Time: 16:53
 */

namespace pi\FrontEnd\FicheDeDressageBundle\Repository;


class f_dressageRepository extends \Doctrine\ORM\EntityRepository
{
    public function deleteFicheDeDressage($id)
    {
        return $this->createQueryBuilder('f')
            ->update('FicheDeDressageBundle:f_dressage','f')
            ->set('f.etat',0)
            ->where('f.id = ?1')
            ->setParameter(1,$id)
            ->getQuery()
            ->execute();
    }
}