<?php

namespace pi\FrontEnd\VeterinaireBundle\Controller;

use pi\FrontEnd\DresseurBundle\Entity\Rating;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{


    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $notes=$em->getRepository('DresseurBundle:Rating')->findAll();
//        $note=$em->getRepository('DresseurBundle:Rating')->moyenneNote();
        $veterinaires = $em->getRepository('FicheDeSoinBundle:User')->findVeterinaireQB();
        return $this->render('@Veterinaire/veterinaires.html.twig', array(
            'veterinaires' => $veterinaires,

        ));
    }

    public function showVetAction(Request $request ,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $vet=$em->getRepository('FicheDeSoinBundle:User')->find($id);
        $note=$em->getRepository('DresseurBundle:Rating')->moyenneNote($id);
        $comment=$em->getRepository('DresseurBundle:Rating')->affCom($id);
        $rai=$em->getRepository('DresseurBundle:Rating')->findBy(array('idUser'=>$id));
        $user = $this->getUser();
        $gateau=intval($note);
        $r=round($note[0]['noteuser'],0);

        $affectnote=new Rating();
        $affectnote->setNote($r);
        $form = $this->createForm('pi\FrontEnd\DresseurBundle\Form\Rating2Type',$affectnote);
        $form->handleRequest($request);
        $affectnote->setIdMembre($user);
        $affectnote->setIdUser($vet);

        if($form->isSubmitted() && $form->isValid())
        {
            //var_dump($affectnote);die();
            $em->persist($affectnote);
            $em->flush();
            $this->redirectToRoute('front_end_show_vet',array('id'=>$id));
            return $this->render('@Veterinaire/showVet.html.twig', array(
                'vet' => $vet,
                'notee'=>$note,
                'form' => $form->createView(),
                'com'=>$comment,
                'rai'=>$rai
            ));
        }
       // var_dump($note);die();
        return $this->render('@Veterinaire/showVet.html.twig', array(
            'vet' => $vet,
            'notee'=>$note,
            'form' => $form->createView(),
            'com'=>$comment,
            'rai'=>$rai

        ));
    }

    public function affecteLaNoteAction(Request $request ,$id )
    {

        $note=new Rating();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm('Rating2Type', $note);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $note->setIdMembre($user);
            $note->setIdUser($id);
            $em->persist($note);
            $em->flush();
            $this->redirectToRoute('front_end_vet');
        }
        return $this->render('@Veterinaire/veterinaires.html.twig', array('form' => $form->createView()));
    }

}
