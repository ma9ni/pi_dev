<?php
/**
 * Created by PhpStorm.
 * User: pc asus
 * Date: 29/03/2018
 * Time: 01:27
 */

namespace pi\FrontEnd\VeterinaireBundle\Repository;


class veterinaireRepository extends \Doctrine\ORM\EntityRepository
{
    public function  findVeterinaireQB(){

        $queryBuilder=$this->createQueryBuilder('s');
        $queryBuilder->where("s.roles=:roles")->setParameter('roles','a:1:{i:0;s:9:"ROLE_VETE";}');
        return $queryBuilder->getQuery()->getResult();

    }
}