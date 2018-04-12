<?php

namespace pi\FrontEnd\CommercialBundle\Controller;

use pi\FrontEnd\CommercialBundle\CommercialBundle;
use pi\FrontEnd\CommercialBundle\Entity\Accessoire;
use pi\FrontEnd\CommercialBundle\Entity\Nourriture;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use pi\FrontEnd\CommercialBundle\Form\AccessoireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{


    public function afficherAccessoireAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $accessoire = $em->getRepository("CommercialBundle:Accessoire")->find($page);
        $monuser = $em->getRepository("FicheDeSoinBundle:User")->find($accessoire->getIdMembre());
        return $this->render('CommercialBundle:accessoire_views:afficher_accessoire.html.twig'
            ,array("accessoire"=>$accessoire,"proprio"=>$monuser));
    }


    public function indexAction()
    {
        return $this->render('CommercialBundle:Default:index.html.twig');
    }


    public function listingAccessoireAction()
    {
        $em = $this->getDoctrine()->getManager();
        $animaux = $em->getRepository("CommercialBundle:Accessoire")->findAll();
        return $this->render('CommercialBundle:accessoire_views:listing_accessoire.html.twig',array("animaux"=>$animaux));
    }

    public function listingnourritureAction()
    {
        $em = $this->getDoctrine()->getManager();
        $nourritures = $em->getRepository("CommercialBundle:Nourriture")->findAll();
        return $this->render('CommercialBundle:nourriture_views:listing_nourriture.html.twig',array("nourritures"=>$nourritures));
    }

    public function afficherNourritureAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $nourriture = $em->getRepository("CommercialBundle:Nourriture")->find($page);
        $monuser = $em->getRepository("FicheDeSoinBundle:User")->find($nourriture->getIdMembre());
        return $this->render('CommercialBundle:nourriture_views:afficher_nourriture.html.twig'
            ,array("nourriture"=>$nourriture,"proprio"=>$monuser));
    }

    public function ajouterAccessoireAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $temp = new Accessoire();
        $form = $this->createForm('pi\FrontEnd\CommercialBundle\Form\AccessoireType',$temp);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $temp->setIdMembre($user);
            $em->persist($temp);
            $em->flush();
            return $this->redirectToRoute('listing_accessoire');
        }
        return $this->render('CommercialBundle:accessoire_views:ajouter_accessoire.html.twig'
            ,array("form"=>$form->createView())  );
    }

    public function ajouterNourritureAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $temp = new Nourriture();
        $form = $this->createForm('pi\FrontEnd\CommercialBundle\Form\NourritureType',$temp);
        $form->handleRequest($request);
        if ($form->isSubmitted() ) {
            if($temp->getPhoto()==""){
                $temp->setPhoto("0.jpg");
            }
            $user = $this->getUser();
            $temp->setIdMembre($user);
            $em->persist($temp);
            $em->flush();
            return $this->redirectToRoute('listing_nourriture');
        }
        return $this->render('CommercialBundle:nourriture_views:ajouter_nourriture.html.twig'
            ,array("form"=>$form->createView())  );
    }

    public function GererAnnoncesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('CommercialBundle:Accessoire')->findBy([
            "idMembre" => $this->getUser(),
            "etat" => 1
        ]);
        $entities1 = $em->getRepository('CommercialBundle:Nourriture')->findBy([
            "idMembre" => $this->getUser(),
            "etat" => 1
        ]);
        return $this->render('CommercialBundle:accessoire_views:gererAnnonces.html.twig',array("accessoires"=>$entities,"nourritures"=>$entities1));
    }
    public function GererAnnonceAction(Request $request,$type,$produit)
    {
        //l'inconvenient avec cette methode c'est que on a du mal a mettre a jour le champ image
        $em = $this->getDoctrine()->getManager();
        if($type==0){
            /*c'est un accessoire*/
            $pro=$em->getRepository('CommercialBundle:Accessoire')->find($produit);
            $haya=$em->getRepository('CommercialBundle:Accessoire')->find($produit)->getPhoto();
        }else{
            /*c'est une nourriture*/
            $pro=$em->getRepository('CommercialBundle:Nourriture')->find($produit);
            $haya=$em->getRepository('CommercialBundle:Nourriture')->find($produit)->getPhoto();

        }
        $pro->setPhoto(null);
        if($type==0){
            /*c'est un accessoire*/
            $pro=$em->getRepository('CommercialBundle:Accessoire')->find($produit);
            $form = $this->createForm('pi\FrontEnd\CommercialBundle\Form\AccessoireType',$pro);
            $form->handleRequest($request);
            if($form ->isSubmitted()){
                $em->persist($pro);
                $em->flush();
                return $this->redirectToRoute('gererAnnonces');

            }
        }else{
            /*c'est une nourriture*/
            $pro=$em->getRepository('CommercialBundle:Nourriture')->find($produit);
            $form = $this->createForm('pi\FrontEnd\CommercialBundle\Form\NourritureType',$pro);
            $form->handleRequest($request);
            if($form ->isSubmitted()){
                $em->persist($pro);
                $em->flush();
                return $this->redirectToRoute('gererAnnonces');
            }
        }
        return $this->render('@Commercial/accessoire_views/gererAnnonce.html.twig'
            ,array("image"=>$haya , "type"=>$type , "form"=>$form->createView()));
    }


    public function deleteAction(Request $request, $id,$type)
    {
        $em = $this->getDoctrine()->getManager();
        if ($type == 0) {
            $repository = $em->getRepository('CommercialBundle:Accessoire');
        } else {
            $repository = $em->getRepository('CommercialBundle:Nourriture');
        }
        $produit = $repository->find($id);
        $em->remove($produit);
        $em->flush();

        $session = $request->getSession();
        $session->getFlashBag()->add('info', 'Nouvelle bien supprimée.');

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('CommercialBundle:Accessoire')->findBy([
            "idMembre" => $this->getUser(),
            "etat" => 1
        ]);
        $entities1 = $em->getRepository('CommercialBundle:Nourriture')->findBy([
            "idMembre" => $this->getUser(),
            "etat" => 1
        ]);
        return $this->render('CommercialBundle:accessoire_views:gererAnnonces.html.twig', array("accessoires" => $entities, "nourritures" => $entities1));
    }
}
