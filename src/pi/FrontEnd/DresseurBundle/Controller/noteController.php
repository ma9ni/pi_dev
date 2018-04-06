<?php

namespace pi\FrontEnd\DresseurBundle\Controller;

use pi\FrontEnd\DresseurBundle\Entity\Rating;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class noteController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function afficheNoteAction(Request $request ,$id )
    {    $em = $this->getDoctrine()->getManager();
         $notes=$em->getRepository('DresseurBundle:Rating')->findAll();
        $note=new Rating();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm('pi\FrontEnd\DresseurBundle\Form\RatingType', $note);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $note->setIdMembre($user);
            $note->setIdUser($id);
            $em->persist($note);
            $em->flush();
            $this->redirectToRoute('aff_note');
        }

        return $this->render('@Veterinaire/veterinaires.html.twig', array('notes' => $notes,'form' => $form->createView() ));
    }

    public function affecteLaNoteAction(Request $request,  $id)
    {
        $note=new Rating();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm('pi\FrontEnd\DresseurBundle\Form\RatingType', $note);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
        $note->setIdMembre($user);
        $note->setIdUser(2);
        $em->persist($note);
        $em->flush();
         $this->redirectToRoute('aff_note');
        }
        return $this->render('@Dresseur/afficheLaNote', array( 'form' => $form->createView()));



    }
}
