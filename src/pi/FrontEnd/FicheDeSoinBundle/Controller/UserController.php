<?php

namespace pi\FrontEnd\FicheDeSoinBundle\Controller;

use pi\FrontEnd\FicheDeSoinBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('FicheDeSoinBundle:User')->findAll();
//                $queryBuilder =$em->getRepository('FicheDeSoinBundle:User')->createQueryBuilder('user');
//        if ( $request->query->getAlnum('filter')){
//           $queryBuilder
//               ->where('user.id LIKE :id')
//               ->setParameter('user', '%' . $request->query->getAlnum('filter'). '%');
//        }
//
//        $query =$queryBuilder->getQuery();



        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(User $user)
    {

        return $this->render('user/show.html.twig', array(
            'user' => $user,
        ));
    }
}
