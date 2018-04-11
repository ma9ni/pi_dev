<?php

namespace pi\FrontEnd\FicheDeDressageBundle\Controller;

use pi\FrontEnd\FicheDeDressageBundle\Entity\f_dressage;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Finder\Exception\AccessDeniedException;
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
//        $this->denyAccessUnlessGranted('ROLE_DRESS', null, 'Unable to access this page!');
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_DRESS')) {
            // Sinon on déclenche une exception « Accès interdit »
            return $this->redirectToRoute('vetno active');
//            throw new AccessDeniedException('Accès limité aux auteurs.');
        }
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $conf= $user->getConfirmation();
        if ($conf == 1) {

            $f_dressages = $em->getRepository('FicheDeDressageBundle:f_dressage')
                ->findBy(array("idMembre" => $user, "etat" => 1));
            return $this->render('@FicheDeDressage/f_dressage/index.html.twig', array(
                'f_dressages' => $f_dressages,
            ));
        } else
        {
            return $this->redirectToRoute('vetno active');
//                    var_dump($user);
        }
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
            $a1=$form->get('accompagnement')->getData();
            $a2=$form->get('interception')->getData();
            $a3=$form->get('obeissance')->getData();
            $a4=$form->get('displine')->getData();
            $total=($a1+$a2+$a3+$a4)/4;
//            var_dump($total);
            $f_dressage->setNoteTotale($total);
            $em->persist($f_dressage);
            $em->flush();
            return $this->redirectToRoute('f_dressage_index', array('id' => $f_dressage->getId()));
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
    {  $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($f_dressage);

        return $this->render('@FicheDeDressage/f_dressage/show.html.twig', array(
            'f_dressage' => $f_dressage,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    public function imprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $f_dressages = $em->getRepository('FicheDeDressageBundle:f_dressage')
            ->find($id);
        $idd=$f_dressages->getIdAnimal();

        $rai=$em->getRepository('FicheDeSoinBundle:animal')->find($idd);
        if (!$f_dressages) {
            return $this->redirectToRoute('f_dressage_index');
        }

        $html = $this->renderView('@FicheDeDressage/imprimer.html.twig',array(
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
            $pdf->Output('Facture.pdf');


//require 'phpmailer.php';

        }catch(\HTML2PDF_exception $e){
            die($e);
        }

        $response = new Response();
        $response->headers->set('Content-type' , 'application/pdf');

        return $response;

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

        $a1=$editForm->get('accompagnement')->getData();
        $a2=$editForm->get('interception')->getData();
        $a3=$editForm->get('obeissance')->getData();
        $a4=$editForm->get('displine')->getData();
        $total=($a1+$a1+$a2+$a3+$a4)/4;
        $f_dressage->setNoteTotale($total);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('f_dressage_index', array('id' => $f_dressage->getId()));
        }

        return $this->render('@FicheDeDressage/f_dressage/edit.html.twig', array(
            'f_dressage' => $f_dressage,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a f_dressage entity.
     * @Route("/delete/{id}", name="f_dressage_delete")
     */
    public function deleteAction(f_dressage $f_dressage)
    {
        $em = $this->getDoctrine()->getManager();
        $id=$f_dressage->getId();
        $em->getRepository('FicheDeDressageBundle:f_dressage')->deleteFicheDeDressage($id);
        $em->flush();
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
