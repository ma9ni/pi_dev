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

    public function ConfirmerUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $conf=$em->getRepository('FicheDeSoinBundle:User')->find($id);
        $conf->setConfirmation(1);
        $em->persist($conf);
        $em->flush();
        return $this->redirectToRoute('admin_listVet');
    }

    public function blockUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $conf=$em->getRepository('FicheDeSoinBundle:User')->find($id);
        $conf->setConfirmation(0);
        $em->persist($conf);
        $em->flush();
        return $this->redirectToRoute('admin_listVet');
    }
}
