<?php

namespace pi\FrontEnd\VeterinaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VeterinaireBundle:Default:index.html.twig');
    }
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $veterinaires = $em->getRepository('FicheDeSoinBundle:User')->findVeterinaireQB();
        return $this->render('@Veterinaire/veterinaires.html.twig', array(
            'veterinaires' => $veterinaires,
        ));
    }
}
