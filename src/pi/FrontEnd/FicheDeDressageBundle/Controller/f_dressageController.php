<?php

namespace pi\FrontEnd\FicheDeDressageBundle\Controller;

use pi\FrontEnd\FicheDeDressageBundle\Entity\f_dressage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * F_dressage controller.
 *
 * @Route("f_dressage")
 */
class f_dressageController extends Controller
{
    /**
     * Lists all f_dressage entities.
     * @Route("/index", name="f_dressage_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $f_dressages = $em->getRepository('FicheDeDressageBundle:f_dressage')->findAll();
        return $this->render('@FicheDeDressage/f_dressage/index.html.twig', array(
            'f_dressages' => $f_dressages,
        ));
    }
    /**
     * Creates a new f_dressage entity.
     *
     * @Route("/new", name="f_dressage_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $f_dressage = new F_dressage();
        $form = $this->createForm('pi\FrontEnd\FicheDeDressageBundle\Form\f_dressageType', $f_dressage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $f_dressage->setEtat(1);
            $f_dressage->setIdMembre($user);
            $em->persist($f_dressage);
            $em->flush();
            return $this->redirectToRoute('f_dressage_show', array('id' => $f_dressage->getId()));
        }

        return $this->render('@FicheDeDressage/f_dressage/new.html.twig', array(
            'f_dressage' => $f_dressage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a f_dressage entity.
     *
     * @Route("/show/{id}", name="f_dressage_show")
     * @Method("GET")
     */
    public function showAction(f_dressage $f_dressage)
    {
        $deleteForm = $this->createDeleteForm($f_dressage);

        return $this->render('@FicheDeDressage/f_dressage/show.html.twig', array(
            'f_dressage' => $f_dressage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing f_dressage entity.
     *
     * @Route("/edit/{id}", name="f_dressage_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, f_dressage $f_dressage)
    {
        $deleteForm = $this->createDeleteForm($f_dressage);
        $editForm = $this->createForm('pi\FrontEnd\FicheDeDressageBundle\Form\f_dressageType', $f_dressage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('f_dressage_edit', array('id' => $f_dressage->getId()));
        }

        return $this->render('@FicheDeDressage/f_dressage/edit.html.twig', array(
            'f_dressage' => $f_dressage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a f_dressage entity.
     *
     * @Route("/delete/{id}", name="f_dressage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, f_dressage $f_dressage)
    {
        $form = $this->createDeleteForm($f_dressage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($f_dressage);
            $em->flush();
        }

        return $this->redirectToRoute('f_dressage_index');
    }

    /**
     * Creates a form to delete a f_dressage entity.
     *
     * @param f_dressage $f_dressage The f_dressage entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(f_dressage $f_dressage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('f_dressage_delete', array('id' => $f_dressage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
