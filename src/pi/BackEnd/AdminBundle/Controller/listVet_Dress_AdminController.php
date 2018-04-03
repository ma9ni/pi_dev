<?php

namespace pi\BackEnd\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class listVet_Dress_AdminController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $veterinaires = $em->getRepository('FicheDeSoinBundle:User')->findUser();
        return $this->render('@Admin/veterinaire_Admin.html.twig', array(
            'veterinaires' => $veterinaires,
        ));
    }
}
