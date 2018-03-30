<?php

namespace pi\FrontEnd\FicheDeSoinBundle\Controller;

use pi\FrontEnd\FicheDeSoinBundle\Entity\f_soin;
use pi\FrontEnd\FicheDeSoinBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * F_soin controller.
 *
 * @Route("f_soin")
 */
class f_soinController extends Controller
{
    /**
     * Lists all f_soin entities.
     * @Route("/index", name="f_soin_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $f_soins = $em->getRepository('FicheDeSoinBundle:f_soin')->findBy(array("idMembre"=>$user,"etat"=>1));
        return $this->render('@FicheDeSoin/f_soin/index.html.twig', array(
            'f_soins' => $f_soins,
        ));
    }

    /**
     * Creates a new f_soin entity.
     *
     * @Route("/new", name="f_soin_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $f_soin = new F_soin();
        $form = $this->createForm('pi\FrontEnd\FicheDeSoinBundle\Form\f_soinType', $f_soin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $f_soin->setIdMembre($user);
            $f_soin->setDateCreation(new \DateTime());
            $f_soin->setEtat(1);
            $em->persist($f_soin);
            $em->flush();
            return $this->redirectToRoute('f_soin_index');
        }
        return $this->render('@FicheDeSoin/f_soin/new.html.twig', array(
            'f_soin' => $f_soin,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a f_soin entity.
     * @Route("/show/{id}", name="f_soin_show")
     * @Method("GET")
     */
    public function showAction(f_soin $f_soin)
    {
        $deleteForm = $this->createDeleteForm($f_soin);
        return $this->render('@FicheDeSoin/f_soin/show.html.twig', array(
            'f_soin' => $f_soin,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing f_soin entity.
     *
     * @Route("/edit/{id}", name="f_soin_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, f_soin $f_soin)
    {
        $editForm = $this->createForm('pi\FrontEnd\FicheDeSoinBundle\Form\f_soinType', $f_soin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('f_soin_index');
        }

        return $this->render('@FicheDeSoin/f_soin/edit.html.twig', array(
            'f_soin' => $f_soin,
            'edit_form' => $editForm->createView(),
        ));
    }


    /**
     * @Route("/delete/{id}", name="f_soin_delete")
     */
    public function deleteAction(f_soin $f_soin)
    {
            $em = $this->getDoctrine()->getManager();
            $id=$f_soin->getId();
            $em->getRepository('FicheDeSoinBundle:f_soin')->deleteFicheDeSoin($id);
            $em->flush();
        return $this->redirectToRoute('f_soin_index');
    }
    /**
     * Creates a form to delete a f_soin entity.
     *
     * @param f_soin $f_soin The f_soin entity
     *
     * @return \Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(f_soin $f_soin)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('f_soin_delete', array('id' => $f_soin->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
