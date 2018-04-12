<?php

namespace pi\FrontEnd\FicheDeDressageBundle\Controller;

use pi\FrontEnd\DresseurBundle\Entity\Rating;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render(':FrontEnd:layout.html.twig');
    }

    public function aboutAction()
    {
        return $this->render(':FrontEnd:about.html.twig');
    }

    public function galleryAction()
    {
        return $this->render(':FrontEnd:gallery.html.twig');
    }

    public function contactAction()
    {
        return $this->render(':FrontEnd:contact.html.twig');
    }



    public function dressAction(Request $request)
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
        $veterinaires = $em->getRepository('FicheDeSoinBundle:User')->findDressQB();
        return $this->render('@FicheDeDressage/dressuer.html.twig' , array(
            'veterinaires' => $veterinaires,
            'rech'=>$rech->createView(),
            'notes'=>$result,

        ));
    }

    public function redirectAction()
    {
        $user=$this->get('security.token_storage')->getToken()->getUser();
        $role=$user->getRoles();

        var_dump($role);


        if ($role[0]=='ROLE_VETE'){

            return $this->redirectToRoute('f_soin_index');
        }
        elseif ($role[0]=='ROLE_DRESS'){
            return $this->redirectToRoute('f_dressage_index');
        }
        else{return $this->redirectToRoute('front_end_homepage');}
    }



    public function showDressAction(Request $request ,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $vet=$em->getRepository('FicheDeSoinBundle:User')->find($id);
        $note=$em->getRepository('DresseurBundle:Rating')->moyenneNote($id);

        if (empty($note)){

//            var_dump($note);
//            die();
//
//            echo "Ahmed";
            $r=0;

        }else {

            $r=round($note[0]['noteuser'],0);
//            echo "MAkni";
        }

        $comment=$em->getRepository('DresseurBundle:Rating')->affCom($id);
//        var_dump($vet);die();
        $rai=$em->getRepository('DresseurBundle:Rating')->findBy(array('idUser'=>$id));
        $user = $this->getUser();

        $rait=$em->getRepository('DresseurBundle:Rating')->findBy(array('idUser'=>$id));

//        $gateau=intval($note);
//        $r=round($note[0]['noteuser'],0);
//        $idmembre=round($note[0]['noteuser'],1);


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
            return $this->redirectToRoute('front_end_show_dres',array('id'=>$id));

        }
        // var_dump($note);die();
        return $this->render('@FicheDeDressage/show_Dres.html.twig', array(
            'vet' => $vet,
            'notee'=>$note,
            'form' => $form->createView(),
            'com'=>$comment,
            'rai'=>$rai,
            'rait'=>$rait,

        ));
    }


}
