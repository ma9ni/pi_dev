<?php

namespace pi\FrontEnd\CouncoursBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use pi\FrontEnd\CouncoursBundle\Entity\concours;
use pi\FrontEnd\CouncoursBundle\Entity\demandes;
use pi\FrontEnd\CouncoursBundle\Entity\participation;
use pi\FrontEnd\FicheDeSoinBundle\Entity\animal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Concour controller.
 *
 * @Route("concours")
 */
class concoursController extends Controller
{
    public function StatAction()
    {
 $pieChart = new PieChart();
$em= $this->getDoctrine();
$cncrs = $em->getRepository(concours::class)->findAll();
$totalEtudiant=0;
        foreach($cncrs as $cncr) {
            $totalEtudiant=$totalEtudiant+$cncr->getCapacite();
        }

        $data= array();
        $stat=['cncr', 'capacite'];
        $nb=0;

        array_push($data,$stat);

        foreach($cncrs as $cncr) {
            $stat=array();
            array_push($stat,$cncr->getNom(),(($cncr->getCapacite()) *100)/$totalEtudiant);
            $nb=($cncr->getCapacite()*100)/$totalEtudiant;
            $stat=[$cncr->getType(),$nb];
            array_push($data,$stat);

    }

        $pieChart->getData()->setArrayToDataTable( $data  );
        $pieChart->getOptions()->setTitle('Pourcentages des Types de concours par Capacité');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);


        return $this->render('GrapheBundle:Default:stat.html.twig', array('piechart' => $pieChart));     }

public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $partcipation = new participation();

//        $participationForm = $this->createForm('pi\FrontEnd\CouncoursBundle\Form\participationType', $partcipation);
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $animal=$em->getRepository('pi\FrontEnd\FicheDeSoinBundle\Entity\animal')->findAll();

        $concours = $em->getRepository('ConcoursBundle:concours')->findAll();
        /**
         * @var $paginator \knp\Component\Pager\Paginator
        */
        $paginator=$this->get('knp_paginator');
        $result =$paginator->paginate(
            $concours,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',1)

        );

        if($request->isMethod('post')){
            //var_dump($partcipation->getIdAnimal());die();
            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('pi\FrontEnd\CouncoursBundle\Entity\concours');
            $concour = $repository->findOneBy(array('id' => $request->get('concour')));

            $idanimal=$request->get('animal');
            $animal=$em->getRepository('pi\FrontEnd\FicheDeSoinBundle\Entity\animal')->find($idanimal);
//            $repository2 = $this->getDoctrine()
//                ->getManager()
//                ->getRepository('pi\FrontEnd\FicheDeSoinBundle\Entity\animal');
//            $animal2 = $repository->findOneBy(array('id' => ->get('animal')));


            $partcipation->setIdAnimal($animal);
            $user = $this->getUser();
            $partcipation->setEtat(0);
            $partcipation->setIdConcour($concour);



            $em->persist($partcipation);
            $em->flush();

        }
    $pieChart = new PieChart();
    $em= $this->getDoctrine();
    $cncrs = $em->getRepository(concours::class)->findAll();
    $totalEtudiant=0;
    foreach($cncrs as $cncr) {
        $totalEtudiant=$totalEtudiant+$cncr->getCapacite();
    }

    $data= array();
    $stat=['cncr', 'capacite'];
    $nb=0;

    array_push($data,$stat);

    foreach($cncrs as $cncr) {
        $stat=array();
        array_push($stat,$cncr->getType(),(($cncr->getCapacite()) *100)/$totalEtudiant);
        $nb=($cncr->getCapacite()*100)/$totalEtudiant;
        $stat=[$cncr->getType(),$nb];
        array_push($data,$stat);

    }

    $pieChart->getData()->setArrayToDataTable( $data  );
    $pieChart->getOptions()->setTitle('Pourcentages des Types de concours par Capacité');
    $pieChart->getOptions()->setHeight(500);
    $pieChart->getOptions()->setWidth(900);
    $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
    $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
    $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
    $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
    $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);


        return $this->render('concours/index.html.twig', array(
            'concours' => $result,
            'animal'=>$animal,'piechart' => $pieChart
        ));
    }

    public function  statisAction(){
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $cncrs = $em->getRepository(concours::class)->findAll();
        $totalEtudiant=0;
        foreach($cncrs as $cncr) {
            $totalEtudiant=$totalEtudiant+$cncr->getCapacite();
        }
        $data= array();
        $stat=['cncr', 'capacite'];
        $nb=0;

        array_push($data,$stat);

        foreach($cncrs as $cncr) {
            $stat=array();
            array_push($stat,$cncr->getType(),(($cncr->getCapacite()) *100)/$totalEtudiant);
            $nb=($cncr->getCapacite()*100)/$totalEtudiant;
            $stat=[$cncr->getType(),$nb];
            array_push($data,$stat);

        }

        $pieChart->getData()->setArrayToDataTable( $data  );
        $pieChart->getOptions()->setTitle('Pourcentages des Types de concours par Capacité');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);


        return $this->render('@Concours/stat.html.twig', array(
           'piechart' => $pieChart
        ));

    }
    public function newAction(Request $request)
    {
        $concour = new Concours();
        $form = $this->createForm('pi\FrontEnd\CouncoursBundle\Form\concoursType', $concour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($concour);
            $em->flush();

            return $this->redirectToRoute('concours_show', array('id' => $concour->getId()));
        }

        return $this->render('concours/new.html.twig', array(
            'concour' => $concour,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a concour entity.
     *
     * @Route("/{id}", name="concours_show")
     * @Method("GET")
     */
    public function showAction(concours $concour)
    {
        $deleteForm = $this->createDeleteForm($concour);

        return $this->render('concours/show.html.twig', array(
            'concour' => $concour,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing concour entity.
     *
     * @Route("/{id}/edit", name="concours_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, concours $concour)
    {
        $deleteForm = $this->createDeleteForm($concour);
        $editForm = $this->createForm('pi\FrontEnd\CouncoursBundle\Form\concoursType', $concour);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('concours_edit', array('id' => $concour->getId()));
        }

        return $this->render('concours/edit.html.twig', array(
            'concour' => $concour,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a concour entity.
     *
     * @Route("/{id}/delete", name="concours_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, concours $concour)
    {
        $form = $this->createDeleteForm($concour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($concour);
            $em->flush();
        }

        return $this->redirectToRoute('concours_index');
    }

    /**
     * Creates a form to delete a concour entity.
     *
     * @param concours $concour The concour entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(concours $concour)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('concours_delete', array('id' => $concour->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


}
