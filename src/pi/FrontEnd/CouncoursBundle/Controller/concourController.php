<?php
/**
 * Created by PhpStorm.
 * User: angham
 * Date: 03/04/2018
 * Time: 00:31
 */

namespace pi\FrontEnd\CouncoursBundle\Controller;
use pi\FrontEnd\CouncoursBundle\Entity\concour;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class concourController extends Controller
{
    /**
     * Lists all concour entities.
     * @Route("/index", name="concour_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $concour = $em->getRepository('CouncoursBundle:concour')->findAll();
        return $this->render('@Councours/concour/index.html.twig', array(
            'concour' => $concour,
        ));
    }
    /**
     * Creates a new concour entity.
     *
     * @Route("/new", name="concour_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $concour = new concour();
        $form = $this->createForm('pi\FrontEnd\CouncoursBundle\Form\concourType', $concour);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $concour->setEtat(1);
            $concour->setIdMembre($user);
            $em->persist($concour);
            $em->flush();
            return $this->redirectToRoute('concour_show', array('id' => $concour->getId()));
        }

        return $this->render('@Councours/concour/new.html.twig', array(
            'f_dressage' => $concour,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a concour entity.
     *
     * @Route("/show/{id}", name="concour_show")
     * @Method("GET")
     */
    public function showAction(concour $concour)
    {
        $deleteForm = $this->createDeleteForm($concour);

        return $this->render('@FicheDeDressage/concour/show.html.twig', array(
            'f_dressage' => $concour,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing concour entity.
     *
     * @Route("/edit/{id}", name="concour_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, concour $concour)
    {
        $deleteForm = $this->createDeleteForm($concour);
        $editForm = $this->createForm('pi\FrontEnd\CouncoursBundle\Form\f_dressageType', $concour);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('concour_edit', array('id' => $concour->getId()));
        }

        return $this->render('@Councours/concour/edit.html.twig', array(
            'concour' => $concour,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a concour entity.
     *
     * @Route("/delete/{id}", name="concour_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, concour $concour)
    {
        $form = $this->createDeleteForm($concour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($concour);
            $em->flush();
        }

        return $this->redirectToRoute('concour_index');
    }

    /**
     * Creates a form to delete a concour entity.
     *
     * @param concour $concour The concour entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(concour $concour)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('concour_delete', array('id' => $concour->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    public function requestAction(Request $request,concour $concour)
    {
        $concour = new concour();
        $form = $this->createForm('pi\FrontEnd\CouncoursBundle\Form\co²ncourType', $concour);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $concour->setEtat(1);
            $concour->setIdMembre($user);
            $em->persist($concour);
            $em->flush();
            return $this->redirectToRoute('concour_show', array('id' => $concour->getId()));
        }

        return $this->render('@Councours/concour/new.html.twig', array(
            'f_dressage' => $concour,
            'form' => $form->createView(),
        ));
    }

}