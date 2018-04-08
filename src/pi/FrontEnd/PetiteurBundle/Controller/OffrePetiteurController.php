<?php

namespace pi\FrontEnd\PetiteurBundle\Controller;

use pi\FrontEnd\PetiteurBundle\Entity\OffrePetiteur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Offrepetiteur controller.
 *
 * @Route("offrepetiteur")
 */
class OffrePetiteurController extends Controller
{
    /**
     * Lists all offrePetiteur entities.
     *
     * @Route("/", name="offrepetiteur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offrePetiteurs = $em->getRepository('PetiteurBundle:OffrePetiteur')->findAll();

        return $this->render('offrepetiteur/index.html.twig', array(
            'offrePetiteurs' => $offrePetiteurs,
        ));
    }

    /**
     * Creates a new offrePetiteur entity.
     *
     * @Route("/new", name="offrepetiteur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {   $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();

        $offrePetiteurs = $em->getRepository('PetiteurBundle:OffrePetiteur')->findOneBy(array('idMembre'=>$user));
        if($offrePetiteurs!=null){

            return $this->redirectToRoute('offrepetiteur_edit', array('id' => $offrePetiteurs->getId()));

        }else
        $offrePetiteur = new Offrepetiteur();
        $form = $this->createForm('pi\FrontEnd\PetiteurBundle\Form\OffrePetiteurType', $offrePetiteur);
        $offrePetiteur->setIdMembre($user);
        $offrePetiteur->setEtat(1);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offrePetiteur);
            $em->flush();

            return $this->redirectToRoute('offrepetiteur_show', array('id' => $offrePetiteur->getId()));
        }

        return $this->render('offrepetiteur/new.html.twig', array(
            'offrePetiteur' => $offrePetiteur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a offrePetiteur entity.
     *
     * @Route("/{id}", name="offrepetiteur_show")
     * @Method("GET")
     */
    public function showAction(OffrePetiteur $offrePetiteur)
    {
        $deleteForm = $this->createDeleteForm($offrePetiteur);

        return $this->render('offrepetiteur/show.html.twig', array(
            'offrePetiteur' => $offrePetiteur,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     *
     * @Route("/deleteAdmin/{id}", name="reclamation_deleteAdmin")
     */
    public function deleteAdminAction( OffrePetiteur $offrePetiteur)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($offrePetiteur);
        $em->flush();


        return $this->redirectToRoute('reclamation_indexOffrePetiteur');
    }

    /**
     * Displays a form to edit an existing offrePetiteur entity.
     *
     * @Route("/{id}/edit", name="offrepetiteur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, OffrePetiteur $offrePetiteur)
    {
        $deleteForm = $this->createDeleteForm($offrePetiteur);
        $editForm = $this->createForm('pi\FrontEnd\PetiteurBundle\Form\OffrePetiteurType', $offrePetiteur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offrepetiteur_edit', array('id' => $offrePetiteur->getId()));
        }

        return $this->render('offrepetiteur/edit.html.twig', array(
            'offrePetiteur' => $offrePetiteur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a offrePetiteur entity.
     *
     * @Route("/{id}", name="offrepetiteur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, OffrePetiteur $offrePetiteur)
    {
        $form = $this->createDeleteForm($offrePetiteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($offrePetiteur);
            $em->flush();
        }

        return $this->redirectToRoute('offrepetiteur_index');
    }

    /**
     * Creates a form to delete a offrePetiteur entity.
     *
     * @param OffrePetiteur $offrePetiteur The offrePetiteur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(OffrePetiteur $offrePetiteur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('offrepetiteur_delete', array('id' => $offrePetiteur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
