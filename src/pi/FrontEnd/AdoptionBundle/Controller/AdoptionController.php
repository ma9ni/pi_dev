<?php

namespace pi\FrontEnd\AdoptionBundle\Controller;

use pi\FrontEnd\AdoptionBundle\Entity\Adoption;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Adoption controller.
 *
 * @Route("adoption")
 */
class AdoptionController extends Controller
{
    /**
     * Lists all adoption entities.
     *
     * @Route("/", name="adoption_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adoptions = $em->getRepository('AdoptionBundle:Adoption')->findAll();

        return $this->render('@Adoption/Front/indexAdoption.html.twig', array(
            'adoptions' => $adoptions,
        ));
    }

    /**
     * Creates a new adoption entity.
     *
     * @Route("/new", name="adoption_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $adoption = new Adoption();
        $form = $this->createForm('pi\FrontEnd\AdoptionBundle\Form\AdoptionType', $adoption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($adoption);
            $em->flush();

            return $this->redirectToRoute('adoption_show', array('idAdoption' => $adoption->getIdadoption()));
        }

        return $this->render('adoption/new.html.twig', array(
            'adoption' => $adoption,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a adoption entity.
     *
     * @Route("/{idAdoption}", name="adoption_show")
     * @Method("GET")
     */
    public function showAction(Adoption $adoption)
    {
        $deleteForm = $this->createDeleteForm($adoption);

        return $this->render('adoption/show.html.twig', array(
            'adoption' => $adoption,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing adoption entity.
     *
     * @Route("/{idAdoption}/edit", name="adoption_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Adoption $adoption)
    {
        $deleteForm = $this->createDeleteForm($adoption);
        $editForm = $this->createForm('pi\FrontEnd\AdoptionBundle\Form\AdoptionType', $adoption);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adoption_edit', array('idAdoption' => $adoption->getIdadoption()));
        }

        return $this->render('adoption/edit.html.twig', array(
            'adoption' => $adoption,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a adoption entity.
     *
     * @Route("/{idAdoption}", name="adoption_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Adoption $adoption)
    {
        $form = $this->createDeleteForm($adoption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($adoption);
            $em->flush();
        }

        return $this->redirectToRoute('adoption_index');
    }

    /**
     * Creates a form to delete a adoption entity.
     *
     * @param Adoption $adoption The adoption entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Adoption $adoption)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adoption_delete', array('idAdoption' => $adoption->getIdadoption())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
