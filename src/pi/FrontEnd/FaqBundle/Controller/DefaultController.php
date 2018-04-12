<?php

namespace pi\FrontEnd\FaqBundle\Controller;

use pi\FrontEnd\FaqBundle\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FaqBundle:Default:index.html.twig');
    }

    public function listingFAQClientAction(Request $request)
    {
        //listing des different question avec leurs reponses
        $em = $this->getDoctrine()->getManager();
        $questions = $em->getRepository("FaqBundle:Question")->findBy([
            "etat" => 1
        ]);
        $reponses = $em->getRepository("FaqBundle:Reponse")->findAll();
        //offrire la possibilité de

        $temp = new Question();
        $form = $this->createForm('pi\FrontEnd\FaqBundle\Form\QuestionType',$temp);
        $form->handleRequest($request);
        if ($form->isSubmitted() ) {
            $em->persist($temp);
            $em->flush();
            return $this->redirectToRoute('faq_listing_part_client');
        }
        return $this->render('FaqBundle:faq_views:listing_part_client.html.twig'
            ,array("questions"=>$questions,"reponses"=>$reponses,"form"=>$form->createView()));
    }

}
