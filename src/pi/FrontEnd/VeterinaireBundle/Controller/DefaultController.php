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



    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $notes=$em->getRepository('DresseurBundle:Rating')->findAll();



        if ($request->isMethod('POST')) {

            $veterinaires = $em->getRepository('FicheDeSoinBundle:User')->findVeterinaireNomQB($request->get('recherche'));

            /**
             * @var $paginator \Knp\Component\Pager\Paginator
             */
            $paginator=$this->get('knp_paginator');
            $result= $paginator->paginate(
                $veterinaires,
                $request->query->getInt('page',1),
                $request->query->getInt('limit',3)
            );
            return $this->render('@Veterinaire/veterinaires.html.twig', array(
                'veterinaires' => $result,


            ));

        }


        $veterinaires = $em->getRepository('FicheDeSoinBundle:User')->findVeterinaireQB();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator=$this->get('knp_paginator');
        $result= $paginator->paginate(
            $veterinaires,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );
        return $this->render('@Veterinaire/veterinaires.html.twig', array(
            'veterinaires' => $result,


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


        if (empty($note)){

//            var_dump($note);
//            die();
            echo "Ahmed";
            $r=0;
        }else {
            $r=round($note[0]['noteuser'],0);
            echo "MAkni";
        }


        $affectnote=new Rating();
        $affectnote->setDatenote(new \DateTime());
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
