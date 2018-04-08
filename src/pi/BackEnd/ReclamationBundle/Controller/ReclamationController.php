<?php

namespace pi\BackEnd\ReclamationBundle\Controller;

use pi\BackEnd\ReclamationBundle\Entity\Reclamation;
use pi\FrontEnd\PetiteurBundle\Entity\OffrePetiteur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Reclamation controller.
 *
 * @Route("reclamation")
 */
class ReclamationController extends Controller
{
    /**
     * Lists all reclamation entities.
     *
     * @Route("/Adoption", name="reclamation_indexAdoption")
     * @Method("GET")
     */
    public function indexAdoptionAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reclamations = $em->getRepository('pi\BackEnd\ReclamationBundle\Entity\Reclamation')->ReclamationAdoptionDQL();

        return $this->render('reclamation/index.html.twig', array(
            'reclamations' => $reclamations,
        ));
    }
    /**
     * Lists all reclamation entities.
     *
     * @Route("/OffrePetiteur", name="reclamation_indexOffrePetiteur")
     * @Method("GET")
     */
    public function indexOffrePetiteurAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reclamations = $em->getRepository('ReclamationBundle:Reclamation')->ReclamationOffrePetiteurDQL();

        return $this->render('reclamation/index.html.twig', array(
            'reclamations' => $reclamations,
        ));
    }

    /**
     * Creates a new reclamation entity.
     *
     * @Route("/newAdoption/{id}", name="reclamation_newAdoption")
     * @Method({"GET", "POST"})
     */
    public function newAdoptionAction(Request $request,$id)
    {
        $reclamation = new Reclamation();
        $form = $this->createForm('pi\BackEnd\ReclamationBundle\Form\ReclamationType', $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $adoption=$em->getRepository('pi\FrontEnd\AdoptionBundle\Entity\Adoption')
                ->find($id);
            $reclamation->setIdAdoption($adoption);
            $reclamation->setIdMembre($this->getUser());


            $em->persist($reclamation);
            $em->flush();

            return $this->redirectToRoute('adoption_show', array('idAdoption' => $adoption->getIdAdoption()));
        }

        return $this->render('reclamation/new.html.twig', array(
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ));
    }
    /**
     * Creates a new reclamation entity.
     *
     * @Route("/newOffre/{id}", name="reclamation_newOffre")
     * @Method({"GET", "POST"})
     */
    public function newOffreAction(Request $request,$id)
    {
        $reclamation = new Reclamation();
        $form = $this->createForm('pi\BackEnd\ReclamationBundle\Form\ReclamationType', $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $offre=$em->getRepository('pi\FrontEnd\PetiteurBundle\Entity\OffrePetiteur')
                ->find($id);
            $reclamation->setIdOffre($offre);
            $reclamation->setIdMembre($this->getUser());


            $em->persist($reclamation);
            $em->flush();

            return $this->redirectToRoute('offrepetiteur_show', array('id' => $offre->getId()));
        }

        return $this->render('reclamation/new.html.twig', array(
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reclamation entity.
     *
     * @Route("/{id}", name="reclamation_show")
     * @Method("GET")
     */
    public function showAction(Reclamation $reclamation)
    {
        $deleteForm = $this->createDeleteForm($reclamation);

        return $this->render('reclamation/show.html.twig', array(
            'reclamation' => $reclamation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reclamation entity.
     *
     * @Route("/{id}/edit", name="reclamation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Reclamation $reclamation)
    {
        $deleteForm = $this->createDeleteForm($reclamation);
        $editForm = $this->createForm('pi\BackEnd\ReclamationBundle\Form\ReclamationType', $reclamation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamation_edit', array('id' => $reclamation->getId()));
        }

        return $this->render('reclamation/edit.html.twig', array(
            'reclamation' => $reclamation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reclamation entity.
     *
     * @Route("/{id}", name="reclamation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Reclamation $reclamation)
    {
        $form = $this->createDeleteForm($reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reclamation);
            $em->flush();
        }

        return $this->redirectToRoute('reclamation_indexAdoption');
    }


    /**
     * Creates a form to delete a reclamation entity.
     *
     * @param Reclamation $reclamation The reclamation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reclamation $reclamation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reclamation_delete', array('id' => $reclamation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
