<?php

namespace pi\FrontEnd\AnimaleBundle\Controller;

use pi\FrontEnd\AnimaleBundle\Entity\sosDisparition;
use pi\FrontEnd\FicheDeSoinBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sosdisparition controller.
 *
 * @Route("sosdisparition")
 */
class sosDisparitionController extends Controller
{
    /**
     * Lists all sosDisparition entities.
     *
     * @Route("/my_sos", name="sosdisparition")
     */

    public function index2Action()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $sosDisparitions = $em->getRepository('AnimaleBundle:sosDisparition')->findBy(array("idMembre"=>$user));
        return $this->render('sosdisparition/mesSOS.htm.twig', array(
            'sosDisparitions' => $sosDisparitions,
        ));
    }




    /**
     * Lists all sosDisparition entities.
     *
     * @Route("/", name="sosdisparition_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $sosDisparitions = $em->getRepository('AnimaleBundle:sosDisparition')->findAll();

        return $this->render('sosdisparition/index.html.twig', array(
            'sosDisparitions' => $sosDisparitions,
        ));
    }

    /**
     * Creates a new sosDisparition entity.
     *
     * @Route("/new", name="sosdisparition_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $sosDisparition = new Sosdisparition();
        $form = $this->createForm('pi\FrontEnd\AnimaleBundle\Form\sosDisparitionType', $sosDisparition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var UploadedFile $file
             */
            $file = $sosDisparition->getImage();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('images'), $filename);
            $sosDisparition->setImage($filename);
            $em = $this->getDoctrine()->getManager();
            $sosDisparition->setIdMembre($user);
            $em->persist($sosDisparition);
            $em->flush();

            return $this->redirectToRoute('sosdisparition_show', array('id' => $sosDisparition->getId()));
        }

        return $this->render('sosdisparition/new.html.twig', array(
            'sosDisparition' => $sosDisparition,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sosDisparition entity.
     *
     * @Route("/{id}", name="sosdisparition_show")
     * @Method("GET")
     * @param sosDisparition $sosDisparition
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(sosDisparition $sosDisparition)
    {
        $deleteForm = $this->createDeleteForm($sosDisparition);

        return $this->render('sosdisparition/show.html.twig', array(
            'sosDisparition' => $sosDisparition,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sosDisparition entity.
     *
     * @Route("/{id}/edit", name="sos_disparition_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param sosDisparition $sosDisparition
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, sosDisparition $sosDisparition)
    {

        $deleteForm = $this->createDeleteForm($sosDisparition);

        $editForm = $this->createForm('pi\FrontEnd\AnimaleBundle\Form\sosDisparitionType', $sosDisparition);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            /**
             * @var UploadedFile $file
             */
            $file = $sosDisparition->getImage();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('images'), $filename);
            $sosDisparition->setImage($filename);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sos_disparition_edit', array('id' => $sosDisparition->getId()));
        }

        return $this->render('sosdisparition/edit.html.twig', array(
            'sosDisparition' => $sosDisparition,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sosDisparition entity.
     *
     * @Route("/{id}", name="sosdisparition_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param sosDisparition $sosDisparition
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, sosDisparition $sosDisparition)
    {
        $form = $this->createDeleteForm($sosDisparition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sosDisparition);
            $em->flush();
        }

        return $this->redirectToRoute('sosdisparition_index');
    }

    /**
     * Creates a form to delete a sosDisparition entity.
     *
     * @param sosDisparition $sosDisparition The sosDisparition entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(sosDisparition $sosDisparition)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sosdisparition_delete', array('id' => $sosDisparition->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Deletes a sosDisparition entity.
     *
     * @Route("/envoyer/{id}", name="sos_disparition_envoyer")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public  function ContactAction(Request $request, $id){


        $em=$this->getDoctrine()->getManager();


        if ($request->isMethod('POST')){
            $User=$em->getRepository('pi\FrontEnd\FicheDeSoinBundle\Entity\User')->find($id);

            $email=$request->get('Email');
            $tem=$request->get('Number');
            $nom=$request->get('Name');
            $message=$request->get('Message');
            $messages = \Swift_Message::newInstance()
                ->setSubject('contacter')
                ->setFrom($email)
                ->setTo($User->getEmail())
                ->setBody(
                    $this->renderView(
                        ':sosdisparition:message.html.twig',
                        array('nom' => $nom, 'email'=>$email,
                            'message'=>$message, 'tel'=>$tem)
                    ),
                    'text/html'
                );
            //$mailer=new  \Swift_Mailer('');
            $mailer =$this->get('mailer') ;
            $mailer->send($messages);
            return $this->render(':sosdisparition:messageEnvoyer.html.twig');

        }

        return $this->render(':sosdisparition:EnvoyerMail.html.twig');


    }
}
