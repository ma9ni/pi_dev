<?php

namespace pi\FrontEnd\AdoptionBundle\Controller;

use DateTime;
use pi\FrontEnd\AdoptionBundle\Entity\Adoption;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Adoption controller.
 *
 * @Route("adoption")
 */
class AdoptionController extends Controller
{

    /**
     * Lists all adoption entities.
     *
     * @Route("/", name="adoption_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $adoptions = $em->getRepository('AdoptionBundle:Adoption')->findAll();

        return $this->render('@Adoption/Front/indexAdoption.html.twig', array(
            'adoptions' => $adoptions,
        ));
    }
    /**
     * Lists all adoption entities.
     *
     * @Route("/vos_annonce", name="adoption_vosAnnonces")
     * @Method("GET")
     */
    public function VosAnnonceAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();

        $adoptions = $em->getRepository('AdoptionBundle:Adoption')->findBy(['idMembre'=>$user->getId()]);

        return $this->render('@Adoption/Front/VosAnnonce.html.twig', array(
            'adoptions' => $adoptions,
        ));
    }

    /**
     * Creates a new adoption entity.
     *
     * @Route("/new", name="adoption_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $adoption = new Adoption();
        $form = $this->createForm('pi\FrontEnd\AdoptionBundle\Form\AdoptionType', $adoption);
        $adoption->setEtatadoption(1);
        $adoption->setDateannonce(new DateTime());
        $user = $this->getUser();
        $adoption->setIdMembre($user);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $animal=$em->getRepository('Proxies\__CG__\pi\FrontEnd\FicheDeSoinBundle\Entity\animal')->findBy(array('id_membre'=>$user));

        if ($form->isSubmitted() && $form->isValid()) {
            $idanimal=$request->get('animal');
            $animal=$em->getRepository('Proxies\__CG__\pi\FrontEnd\FicheDeSoinBundle\Entity\animal')->find($idanimal);


            $adoption->setIdAnimal($animal);
            $em = $this->getDoctrine()->getManager();
            $em->persist($adoption);
            $em->flush();

            return $this->redirectToRoute('adopt
            ion_show', array('idAdoption' => $adoption->getIdadoption()));
        }

        return $this->render('@Adoption/Front/new.html.twig', array(
            'adoption' => $adoption,
            'form' => $form->createView(),
            'animal'=>$animal
        ));
    }

    /**
     * Finds and displays a adoption entity.
     *
     * @Route("/{idAdoption}", name="adoption_show")
     * @Method("GET")
     */
    public function showAction(Adoption $adoption)
    {
        $deleteForm = $this->createDeleteForm($adoption);

        return $this->render('@Adoption/Front/show.html.twig', array(
            'adoption' => $adoption,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing adoption entity.
     *
     * @Route("/{idAdoption}/edit", name="adoption_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Adoption $adoption)
    {
        $deleteForm = $this->createDeleteForm($adoption);
        $editForm = $this->createForm('pi\FrontEnd\AdoptionBundle\Form\AdoptionType', $adoption);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adoption_edit', array('idAdoption' => $adoption->getIdadoption()));
        }

        return $this->render('adoption/edit.html.twig', array(
            'adoption' => $adoption,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
public function showAnimal(){
    $em = $this->getDoctrine()->getManager();
    $user=$this->getUser();
$animal=$em->getRepository('Proxies\__CG__\pi\FrontEnd\FicheDeSoinBundle\Entity\animal')->findBy(array('idMembre'=>$user));
return $animal;
    }
    /**
     * Deletes a adoption entity.
     *
     * @Route("/{idAdoption}", name="adoption_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Adoption $adoption)
    {
        $form = $this->createDeleteForm($adoption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($adoption);
            $em->flush();
        }

        return $this->redirectToRoute('adoption_index');
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public  function ContactAction(Request $request, $id){


        $em=$this->getDoctrine()->getManager();

        $adoption=$em->getRepository('AdoptionBundle:Adoption')->find($id);

        if ($request->isMethod('POST')){
            $email=$request->get('Email');
            $tem=$request->get('Number');
            $nom=$request->get('Name');
            $message=$request->get('Message');
            $messages = \Swift_Message::newInstance()
                ->setSubject('contacter')
                ->setFrom($email)
                ->setTo('mourynesse@gmail.com')
            ->setBody(
                $this->renderView(
                    'AdoptionBundle:Front:mail.html.twig',
                    array('nom' => $nom, 'email'=>$email,
                    'message'=>$message, 'tel'=>$tem)
                ),
                'text/html'
            );
           //$mailer=new  \Swift_Mailer('');
           $mailer =$this->get('mailer') ;
            $mailer->send($messages);
            return $this->render('@Adoption/Front/sucess.html.twig');

        }

        return $this->render('@Adoption/Front/contactAnnonceur.html.twig', array('adoption'=>$adoption));


    }

    /**
     * Creates a form to delete a adoption entity.
     *
     * @param Adoption $adoption The adoption entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Adoption $adoption)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adoption_delete', array('idAdoption' => $adoption->getIdadoption())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


}
