<?php

namespace pi\BackEnd\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminGateauController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/admin/userlist", name="user_list")
     */
    public function animalAction()
    {
       $em = $this->getDoctrine()->getManager();
       $animal = $em->getRepository('FicheDeSoinBundle:animal')->findAll();
        return $this->render('@Admin/Default/listAnimeaux.html.twig',['animal'=>$animal]);
    }


    public function sosListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $sos = $em->getRepository('AnimaleBundle:sosDisparition')->findAll();
        return $this->render('@Admin/Default/ListSosDisparition.html.twig', array(
            'sos' => $sos,
        ));
    }
    public function userAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('FicheDeSoinBundle:User')->findAll();
        return $this->render('@Admin/Default/ListUsers.html.twig',['user'=>$user]);
    }



    public function userListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('FicheDeSoinBundle:User')->findAll();
        return $this->render('@Admin/Default/ListUsers.html.twig', array(
            'user' => $user,
        ));
    }


//delete sos
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $object = $em->getRepository('AnimaleBundle:sosDisparition')->find($id);
        $em->remove($object);
        $em->flush();

        return $this->redirectToRoute('admin_sos');



    }

    public function deleteAnimalAction($id){
        $em = $this->getDoctrine()->getManager();
        $animal = $em->getRepository('FicheDeSoinBundle:animal')->find($id);
       // var_dump($animal);
        $em->remove($animal);
        $em->flush();

        return $this->redirectToRoute('admin_animeaux');

    }


    public function deleteUserAction($id){
        $em = $this->getDoctrine()->getManager();
        $animal = $em->getRepository('FicheDeSoinBundle:User')->find($id);
        // var_dump($animal);
        $em->remove($animal);
        $em->flush();

        return $this->redirectToRoute('admin_user');



    }
}
