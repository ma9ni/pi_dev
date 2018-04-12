<?php

namespace pi\BackEnd\AdminBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use pi\FrontEnd\CouncoursBundle\Entity\concours;
use pi\FrontEnd\CouncoursBundle\Entity\participation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Concour controller.
 *
 * @Route("AdminConcours")
 */
class concoursController extends Controller
{

public function indexAction(Request $request)
    {
        $partcipation = new participation();

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
            $request->query->getInt('limit',2)

        );

        if($request->isMethod('post')){
            //var_dump($partcipation->getIdAnimal());die();
            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('pi\FrontEnd\CouncoursBundle\Entity\concours');
            $concour = $repository->findOneBy(array('id' => $request->get('concour')));

            $idanimal=$request->get('animal');
            $animal=$em->getRepository('pi\FrontEnd\FicheDeSoinBundle\Entity\animal')->find($idanimal);



            $partcipation->setIdAnimal($animal);
            $user = $this->getUser();
            $partcipation->setEtat(0);
            $partcipation->setIdConcour($concour);



            $em->persist($partcipation);
            $em->flush();
            return $this->redirectToRoute('Back_concours_show', array('id' => $concour->getId()));


        }
    $pieChart = new PieChart();
    $em= $this->getDoctrine();
    $cncrs = $em->getRepository(concours::class)->findAll();
    $total=0;
    foreach($cncrs as $cncr) {
        $total=$total+$cncr->getCapacite();
    }

    $data= array();
    $stat=['cncr', 'capacite'];
    $nb=0;

    array_push($data,$stat);

    foreach($cncrs as $cncr) {
        $stat=array();
        array_push($stat,$cncr->getType(),(($cncr->getCapacite()) *100)/$total);
        $nb=($cncr->getCapacite()*100)/$total;
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


        return $this->render('@Admin/Concours/index.html.twig', array(
            'concours' => $result,
            'animal'=>$animal,'piechart' => $pieChart
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

            return $this->redirectToRoute('Back_concours_show', array('id' => $concour->getId()));
        }

        return $this->render('@Admin/Concours/new.html.twig', array(
            'concour' => $concour,
            'form' => $form->createView(),
        ));
    }


    public function showAction(concours $concour)
    {
        $deleteForm = $this->createDeleteForm($concour);

        return $this->render('@Admin/Concours/show.html.twig', array(
            'concour' => $concour,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, concours $concour)
    {
        $deleteForm = $this->createDeleteForm($concour);
        $editForm = $this->createForm('pi\FrontEnd\CouncoursBundle\Form\concoursType', $concour);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Back_concours_edit', array('id' => $concour->getId()));
        }

        return $this->render('@Admin/Concours/edit.html.twig', array(
            'concour' => $concour,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction(Request $request, concours $concour)
    {
        $form = $this->createDeleteForm($concour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($concour);
            $em->flush();
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($concour);
        $em->flush();

        return $this->redirectToRoute('Back_Concours_index');
    }


    private function createDeleteForm(concours $concour)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Back_concours_delete', array('id' => $concour->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function acceptAction(Request $request)
    {

//        $participant = new participation();
        $em = $this->getDoctrine()->getManager();
        $participan=$em->getRepository('pi\FrontEnd\CouncoursBundle\Entity\participation')->find($request->get('id'));

        //pour l'envoi
        $animal=$em->getRepository('FicheDeSoinBundle:animal')->find($participan->getIdAnimal());
        $user=$em->getRepository('FicheDeSoinBundle:User')->find($animal->getIdMembre());

//        $participant = $em->getRepository('pi\FrontEnd\CouncoursBundle\Entity\participation')->findOneBy(array('id'=>$request->get('id')))
        $participan->setEtat(1);
       var_dump($participan->getIdConcour()->getCapacite());
        $nbrP=$participan->getIdConcour()->getCapacite();
        $nbr2=$participan->getIdConcour()->setCapacite($nbrP-1);
        $nbrP3=$participan->getIdConcour()->getCapacite();
        var_dump($nbrP3);
//        $em->persist($participan);
        $em->flush();

        $messages = \Swift_Message::newInstance()
            ->setSubject('resultat de votre participation')
            ->setFrom("angham.bensaid@esprit.tn")
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    '@Concours/mail.html.twig',
                    array('message' => "Votre participation est acceptée")
                ),
                'text/html'
            );
        $mailer =$this->get('mailer') ;
        $mailer->send($messages);
        return $this->redirectToRoute('concours_d');
    }
    public function refuserAction(participation $participation)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($participation);
        //pour l'envoi
        $animal=$em->getRepository('FicheDeSoinBundle:animal')->find($participation->getIdAnimal());
        $user=$em->getRepository('FicheDeSoinBundle:User')->find($animal->getIdMembre());

        $em->flush();
        $messages = \Swift_Message::newInstance()
            ->setSubject('resultat de votre participation')
            ->setFrom("angham.bensaid@esprit.tn")
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    '@Concours/mail.html.twig',
                    array('message' => "Votre participation est acceptée")
                ),
                'text/html'
            );
        $mailer =$this->get('mailer') ;
        $mailer->send($messages);
        return $this->redirectToRoute('concours_d');
    }

//    /**
//     * Finds and displays a concour entity.
//     *
//     * @Route("/demande", name="concours_demande")
//     * @Method("GET")
//     */
    public function houssemAction()
    {
        $em = $this->getDoctrine()->getManager();

        $participant = $em->getRepository('pi\FrontEnd\CouncoursBundle\Entity\participation')->findBy(array('etat'=> 0));


//        /**
//         * @var $paginator \knp\Component\Pager\Paginator
//         */
//        $paginator = $this->get('knp_paginator');
//        $result = $paginator->paginate(
//            $concours,
//            $request->query->getInt('page', 1),
//            $request->query->getInt('limit', 2)
//
//        );
//
//
        return $this->render('@Concours/Default/demande.html.twig', array(
            'participation' => $participant,


        ));
    }






}
