<?php

namespace pi\BackEnd\faqAdminBundle\Controller;

use pi\FrontEnd\FaqBundle\Entity\Reponse;
use pi\FrontEnd\FaqBundle\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('faqAdminBundle:Default:index.html.twig');
    }

    public function RepondreAction()
    {
        $em = $this->getDoctrine()->getManager();
        $questions = $em->getRepository("FaqBundle:Question")->findBy([
            "etat" => 0
        ]);
        return $this->render('faqAdminBundle:faq_views:listin_question_attente.html.twig',array("questions"=>$questions));
    }

    public function repAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $temp = new Reponse();
        $form = $this->createForm('pi\FrontEnd\FaqBundle\Form\ReponseType',$temp);
        $form->handleRequest($request);
        if ($form->isSubmitted() ) {
            /*insertion de la nouvelle reponse*/
            $em->persist($temp);
            $em->flush();
            /*affectation de l'id de la reponse*/
            $question= $em->getRepository("FaqBundle:Question")->findBy([
                "id" => $id
            ]);
            $temp= $em->getRepository("FaqBundle:Reponse")->findBy([
                "reponse" => $temp->getReponse()
            ]);

            $question[0]->setIdReponse($temp[0]);
            $question[0]->setEtat(1);
            $em->persist($question[0]);
            $em->flush();
            /*redirection*/
            $questions = $em->getRepository("FaqBundle:Question")->findBy([
                "etat" => 0
            ]);
            return $this->render('faqAdminBundle:faq_views:listin_question_attente.html.twig',array("questions"=>$questions));
        }
        $questionoriginal= $em->getRepository("FaqBundle:Question")->find($id);
        return $this->render('faqAdminBundle:faq_views:rep_admin.html.twig',array("form"=>$form->createView(),"laquestion"=>$questionoriginal));
        }
}
