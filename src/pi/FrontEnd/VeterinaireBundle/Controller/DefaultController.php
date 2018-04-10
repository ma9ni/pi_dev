<?php

namespace pi\FrontEnd\VeterinaireBundle\Controller;

use pi\FrontEnd\DresseurBundle\Entity\Rating;
use pi\FrontEnd\DresseurBundle\Form\rechercheVetParNom;
use pi\FrontEnd\FicheDeSoinBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function recherchePArnomAction(Request $request)
    {
        $vet=new User();
        $em = $this->getDoctrine()->getManager();
        $rech = $this->createForm(rechercheVetParNom::class,$vet);
        $rech->handleRequest($request);

        if ($rech->isSubmitted())
        {$nom=$vet->getUsername();
        $nom;die();
            $veterinair = $em->getRepository('FicheDeSoinBundle:User')->find($nom);
            var_dump($veterinair);
       }

        return $this->render('@Veterinaire/veterinaires.html.twig', array(
            'veterinaires' => $veterinair,
            'rech'=>$rech->createView()

        ));


    }


    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $notes=$em->getRepository('DresseurBundle:Rating')->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator=$this->get('knp_paginator');
       $result= $paginator->paginate(
            $notes,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',1)
        );
        $rech = $this->createFormBuilder()
            ->add('Recherche')
            ->getForm();

        $rech->handleRequest($request);

        if ($rech->isSubmitted() && $rech->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $rech->getData();

        }


//        $note=$em->getRepository('DresseurBundle:Rating')->moyenneNote();
        $veterinaires = $em->getRepository('FicheDeSoinBundle:User')->findVeterinaireQB();
        return $this->render('@Veterinaire/veterinaires.html.twig', array(
            'veterinaires' => $veterinaires,
            'rech'=>$rech->createView(),
           'notes'=>$result,

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

$rait=$em->getRepository('DresseurBundle:Rating')->findBy(array('idUser'=>$id));

        $gateau=intval($note);
        $r=round($note[0]['noteuser'],0);
        $idmembre=round($note[0]['noteuser'],1);


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
            return $this->redirectToRoute('front_end_show_vet',array('id'=>$id));

        }
       // var_dump($note);die();
        return $this->render('@Veterinaire/showVet.html.twig', array(
            'vet' => $vet,
            'notee'=>$note,
            'form' => $form->createView(),
            'com'=>$comment,
            'rai'=>$rai,
            'rait'=>$rait,


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
