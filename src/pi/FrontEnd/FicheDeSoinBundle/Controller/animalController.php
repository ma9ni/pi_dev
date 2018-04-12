<?php

namespace pi\FrontEnd\FicheDeSoinBundle\Controller;

use pi\FrontEnd\FicheDeSoinBundle\Entity\animal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * Animal controller.
 *
 * @Route("animal")
 */
class animalController extends Controller
{
    /**
     * Lists all animal entities.
     *
     * @Route("/my_animals", name="animal_index")
     * @Method("GET")
    */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $animals = $em->getRepository('FicheDeSoinBundle:animal')->findBy(array("idMembre"=>$user));
//        $queryBuilder =$em->getRepository('FicheDeSoinBundle:animal')->createQueryBuilder('animal');
//        if ( $request->query->getAlnum('filter')){
//           $queryBuilder
//               ->where('animal.nom LIKE :nom')
//               ->setParameter('nom', '%' . $request->query->getAlnum('filter'). '%');
//        }
//
//        $query =$queryBuilder->getQuery();


//                /**
//                 * @var $paginator \Knp\Component\Pager\Paginator
//                 */
//                $paginator = $this->get('knp_paginator');
//                $result = $paginator->paginate(
//                    $animals,
//                    $request->query->getInt('page', 1),
//                    $request->query->getInt('page', 5)
//                );

        return $this->render('animal/index.html.twig', [
            'animals' => $animals,
        ]);
    }







    /**
     * Lists all animal entities.
     *
     * @Route("/", name="animal_index")
     */
    public function index2Action()
    {
        $em = $this->getDoctrine()->getManager();
        $animals = $em->getRepository('FicheDeSoinBundle:animal')->findAll();
//        $queryBuilder =$em->getRepository('FicheDeSoinBundle:animal')->createQueryBuilder('animal');
//        if ( $request->query->getAlnum('filter')){
//           $queryBuilder
//               ->where('animal.nom LIKE :nom')
//               ->setParameter('nom', '%' . $request->query->getAlnum('filter'). '%');
//        }
//
//        $query =$queryBuilder->getQuery();
        return $this->render('animal/indexall.html.twig', [
            'animals' => $animals,
        ]);
    }

    

    /**
     * Creates a new animal entity.
     *
     * @Route("/new", name="animal_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $animal = new Animal();
        $form = $this->createForm('pi\FrontEnd\FicheDeSoinBundle\Form\animalType', $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var UploadedFile $file
             */
            $file = $animal->getImage();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('images'), $filename);
            $animal->setImage($filename);
            $em = $this->getDoctrine()->getManager();
            $animal->setIdMembre($user);
            $em->persist($animal);
            $em->flush();

            return $this->redirectToRoute('animal_show', array('id' => $animal->getId()));
        }

        return $this->render('animal/new.html.twig', array(
            'animal' => $animal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a animal entity.
     *
     * @Route("/{id}", name="animal_show")
     * @Method("GET")
     * @param animal $animal
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(animal $animal)
    {
        $deleteForm = $this->createDeleteForm($animal);
        $em = $this->getDoctrine()->getManager();
        $idd=$animal->getId();
        echo $idd;

        $nb = $em->getRepository('FicheDeSoinBundle:feedback')->findBy(array('idanimal'=>$idd));
//            echo $nb;
//        echo $nb[0];die();
//        var_dump($nb[0]);


//        if (empty($nb)){$nb[0]=0;}
        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
            'delete_form' => $deleteForm->createView(),
            'an' => $nb,

        ]);
    }

    public function addlikeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
       // $nblik=new feedback();

        $em->getRepository('FicheDeSoinBundle:feedback')->add($id);
     //   $nblik->setLikeNumber($nblik->getLikeNumber()+1);
        $em->flush();
       return $this->redirectToRoute('animal_show', array('id' => $id ));

    }



    /**
     * Displays a form to edit an existing animal entity.
     *
     * @Route("/{id}/edit", name="animal_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param animal $animal
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, animal $animal)
    {
        $deleteForm = $this->createDeleteForm($animal);
        $editForm = $this->createForm('pi\FrontEnd\FicheDeSoinBundle\Form\animalType', $animal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('animal_edit', array('id' => $animal->getId()));
        }

        return $this->render('animal/edit.html.twig', array(
            'animal' => $animal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a animal entity.
     *
     * @Route("/{id}", name="animal_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param animal $animal
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, animal $animal)
    {
        $form = $this->createDeleteForm($animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($animal);
            $em->flush();
        }

        return $this->redirectToRoute('animal_index');
    }

    /**
     * Creates a form to delete a animal entity.
     *
     * @param animal $animal The animal entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(animal $animal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('animal_delete', array('id' => $animal->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }


    /**
     * Deletes a animal entity.
     *
     * @Route("/recherche", name="animal_recherche")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public  function rechercheAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $motcle=$request->get('motcle');
        $repository=$em->getRepository('FicheDeSoinBundle:animal');
        $query = $repository->createQueryBuilder('a')
            ->where('a.nom like :nom')
            ->setParameter('nom', $motcle. '%')
            ->orderBy('a.nom', 'ASC')
            ->getQuery();
        $listanimales= $query->getResult();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $listanimales = $paginator->paginate(
            $listanimales,
            $request->query->getInt('page', 1)

        );
        return $this->render('animal/indexall.html.twig', array('animals' => $listanimales));
    }

}
