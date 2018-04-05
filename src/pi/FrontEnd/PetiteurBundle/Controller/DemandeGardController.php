<?php

namespace pi\FrontEnd\PetiteurBundle\Controller;

use pi\FrontEnd\PetiteurBundle\Entity\DemandeGard;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

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

        $demandeGards = $em->getRepository('PetiteurBundle:DemandeGard')->findAll();

        return $this->render('demandegard/index.html.twig', array(
            'demandeGards' => $demandeGards,
        ));
    }

    /**
     * Creates a new demandeGard entity.
     *
     * @Route("/new", name="demandegard_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $demandeGard = new Demandegard();
        $form = $this->createForm('pi\FrontEnd\PetiteurBundle\Form\DemandeGardType', $demandeGard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demandeGard);
            $em->flush();

            return $this->redirectToRoute('demandegard_show', array('id' => $demandeGard->getId()));
        }

        return $this->render('demandegard/new.html.twig', array(
            'demandeGard' => $demandeGard,
            'form' => $form->createView(),
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
