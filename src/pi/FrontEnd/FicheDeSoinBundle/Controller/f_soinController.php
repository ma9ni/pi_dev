<?php

namespace pi\FrontEnd\FicheDeSoinBundle\Controller;

use pi\FrontEnd\FicheDeSoinBundle\Entity\f_soin;
use pi\FrontEnd\FicheDeSoinBundle\Entity\User;
use Spipu\Html2Pdf\Html2Pdf;
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
        //        $this->denyAccessUnlessGranted('ROLE_DRESS', null, 'Unable to access this page!');
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_VETE')) {
            // Sinon on déclenche une exception « Accès interdit »
            return $this->redirectToRoute('vetno active');
//            throw new AccessDeniedException('Accès limité aux auteurs.');
        }
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
//            var_dump($user);
           $conf= $user->getConfirmation();
           if ($conf == 1)
           {
               $f_soins = $em->getRepository('FicheDeSoinBundle:f_soin')->findBy(array("idMembre"=>$user,"etat"=>1));
//               $this->redirectToRoute('vetno active');
//               var_dump($conf);
               return $this->render('@FicheDeSoin/f_soin/index.html.twig', array(
                   'f_soins' => $f_soins,
                   'user'=>$user,
               ));
           }
           else
               {
                   return $this->redirectToRoute('vetno active');
//                    var_dump($user);
               }

    }


    /**
     * Creates a new f_soin entity.
     *
     * @Route("/new", name="f_soin_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
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
     * @param f_soin $f_soin
     * @return \Symfony\Component\HttpFoundation\Response
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
     * @Route("/edit/{id}", name="f_soin_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param f_soin $f_soin
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
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

    public function imprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $f_dressages = $em->getRepository('FicheDeSoinBundle:f_soin')
            ->find($id);
        $idd=$f_dressages->getIdAnimal();

        $rai=$em->getRepository('FicheDeSoinBundle:animal')->find($idd);
        if (!$f_dressages) {
            return $this->redirectToRoute('f_soin_index');
        }

        $html = $this->renderView('@FicheDeSoin/imprimer.html.twig',array(
            'facture'=>$f_dressages,
            'anim'=>$rai

        ));

        try{
            $pdf = new Html2Pdf('P','A4','fr');
            $pdf->pdf->SetAuthor('SoukElMedina');
            $pdf->pdf->SetTitle('Facture ');
            $pdf->pdf->SetSubject('Facture SoukElMedina');
            $pdf->pdf->SetKeywords('facture,soukelmedina');
            $pdf->pdf->SetDisplayMode('real');
            $pdf->writeHTML($html);
            $pdf->Output('Fiche De Soin.pdf');


//require 'phpmailer.php';

        }catch(\HTML2PDF_exception $e){
            die($e);
        }

        $response = new Response();
        $response->headers->set('Content-type' , 'application/pdf');

        return $response;

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
