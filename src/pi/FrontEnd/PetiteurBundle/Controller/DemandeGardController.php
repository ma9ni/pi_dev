<?php

namespace pi\FrontEnd\PetiteurBundle\Controller;

use pi\FrontEnd\PetiteurBundle\Entity\DemandeGard;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Demandegard controller.
 *
 * @Route("demandegard")
 */
class DemandeGardController extends Controller
{
    /**
     * Lists all demandeGard entities.
     *
     * @Route("/", name="demandegard_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $offre=$em->getRepository('PetiteurBundle:OffrePetiteur')->findOneBy(array('idMembre'=>$user));

        $demandeGards = $em->getRepository('PetiteurBundle:DemandeGard')->findBy(array('idOffre'=>$offre ,'etat'=> 0));

        return $this->render('demandegard/index.html.twig', array(
            'demandeGards' => $demandeGards,
        ));
    }
    /**
     * Lists all demandeGard entities.
     *
     * @Route("/demandeAccepter", name="demandegard_demandeAccepter")
     * @Method("GET")
     */
    public function demandeAccepterAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $offre=$em->getRepository('PetiteurBundle:OffrePetiteur')->findOneBy(array('idMembre'=>$user));

        $demandeGards = $em->getRepository('PetiteurBundle:DemandeGard')->findBy(array('idOffre'=>$offre ,'etat'=> 1));

        return $this->render('demandegard/animalGarder.html.twig', array(
            'demandeGards' => $demandeGards,
        ));
    }
    /**
     *
     * @Route("/retourAnimal/{id}", name="demandegard_RetourAnimal")
     * @Method({"GET", "POST"})
     */
    public function RetourAnimalAction( $id){

        $em=$this->getDoctrine()->getManager();
        $demandeGard=$em->getRepository('pi\FrontEnd\PetiteurBundle\Entity\DemandeGard')->find($id);
//        $Offre=$em->getRepository('pi\FrontEnd\PetiteurBundle\Entity\DemandeGard')->find($demandeGard->getIdOffre());
//        $animal=$em->getRepository('pi\FrontEnd\FicheDeSoinBundle\Entity\animal')->find($demandeGard->getIdAnimal());

        $em->getRepository('pi\FrontEnd\PetiteurBundle\Entity\DemandeGard')->changerAnimal($demandeGard->getIdAnimal(),$demandeGard->getIdMembre());

        $em->getRepository('pi\FrontEnd\PetiteurBundle\Entity\DemandeGard')->retour($id);

$em->flush();
return $this->redirectToRoute('demandegard_demandeAccepter');
    }


    /**
     * Creates a new demandeGard entity.
     *
     * @Route("/new/{id}", name="demandegard_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,$id)
    {
        $demandeGard = new Demandegard();
        $form = $this->createForm('pi\FrontEnd\PetiteurBundle\Form\DemandeGardType', $demandeGard);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $animal=$em->getRepository('pi\FrontEnd\FicheDeSoinBundle\Entity\animal')->findBy(array('id_membre' => $this->getUser()));

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $demandeGard->setIdMembre($this->getUser());
            $animal=$em->getRepository('pi\FrontEnd\FicheDeSoinBundle\Entity\animal')->find($request->get('animal'));
            $demandeGard->setIdAnimal($animal);
            $offre=$em->getRepository('pi\FrontEnd\PetiteurBundle\Entity\OffrePetiteur')->find($id);
            $demandeGard->setIdOffre($offre);
            $demandeGard->setEtat(0);
            $em->persist($demandeGard);
            $em->flush();

            return $this->redirectToRoute('demandegard_show', array('id' => $demandeGard->getId()));
        }

        return $this->render('demandegard/new.html.twig', array(
            'demandeGard' => $demandeGard,
            'form' => $form->createView(),
            'animal' => $animal,
        ));
    }

    /**
     * Finds and displays a demandeGard entity.
     *
     * @Route("/{id}", name="demandegard_show")
     * @Method("GET")
     */
    public function showAction(DemandeGard $demandeGard)
    {
        $deleteForm = $this->createDeleteForm($demandeGard);

        return $this->render('demandegard/show.html.twig', array(
            'demandeGard' => $demandeGard,
            'delete_form' => $deleteForm->createView(),
        ));
    }



    /**
     * Displays a form to edit an existing demandeGard entity.
     *
     * @Route("/{id}/edit", name="demandegard_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, DemandeGard $demandeGard)
    {
        $deleteForm = $this->createDeleteForm($demandeGard);
        $editForm = $this->createForm('pi\FrontEnd\PetiteurBundle\Form\DemandeGardType', $demandeGard);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demandegard_edit', array('id' => $demandeGard->getId()));
        }

        return $this->render('demandegard/edit.html.twig', array(
            'demandeGard' => $demandeGard,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a demandeGard entity.
     *
     * @Route("/{id}", name="demandegard_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, DemandeGard $demandeGard)
    {
        $form = $this->createDeleteForm($demandeGard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($demandeGard);
            $em->flush();
        }

        return $this->redirectToRoute('demandegard_index');
    }
    /**
     *
     * @Route("/accept/{id}", name="demandegard_accept")
     */

    public function accepterAction( $id){

        $em=$this->getDoctrine()->getManager();
        $demandeGard=$em->getRepository('pi\FrontEnd\PetiteurBundle\Entity\DemandeGard')->find($id);
        $offre=$em->getRepository('pi\FrontEnd\PetiteurBundle\Entity\OffrePetiteur')
            ->find($demandeGard->getIdOffre());

        $em->getRepository('pi\FrontEnd\PetiteurBundle\Entity\DemandeGard')->accept($id);
        $em->getRepository('pi\FrontEnd\PetiteurBundle\Entity\DemandeGard')
            ->changerAnimal($demandeGard->getIdAnimal(),$offre->getIdMembre());

        $em->flush();

        return $this->redirectToRoute('demandegard_index');

    }
    /**
     *
     * @Route("/refuse/{id}", name="demandegard_refuse")
     */

    public function refuseAction( $id){

        $em=$this->getDoctrine()->getManager();

        $em->getRepository('pi\FrontEnd\PetiteurBundle\Entity\DemandeGard')->refuse($id);
        $em->flush();

        return $this->redirectToRoute('demandegard_index');

    }
    /**
     *
     * @Route("/listdemandeUtilisateur/", name="demandegard_listdemandeUtilisateur")
     */


    public function listdemandeUtilisateurAction(){
        $user=$this->getUser();
        $em=$this->getDoctrine()->getManager();
        $demandes=$em->getRepository('pi\FrontEnd\PetiteurBundle\Entity\DemandeGard')->findBy(array('idMembre'=>$user->getId()));

        return $this->render('demandegard/listdemandeUtilisateur.html.twig',array('demandeGards'=>$demandes));


    }
    /**
     * Creates a form to delete a demandeGard entity.
     *
     * @param DemandeGard $demandeGard The demandeGard entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DemandeGard $demandeGard)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demandegard_delete', array('id' => $demandeGard->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
