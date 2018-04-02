<?php

namespace pi\BackEnd\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Admin/wrapper.html.twig');
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $veterinaires = $em->getRepository('FicheDeSoinBundle:User')->findAll();
        return $this->render(':BackEnd/pages:listVeterinaire.html.twig', array(
            'veterinaires' => $veterinaires,
        ));
    }
}
