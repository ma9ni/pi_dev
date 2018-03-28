<?php

namespace pi\FrontEnd\FicheDeDressageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('::layout.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('::about.html.twig');
    }

    public function galleryAction()
    {
        return $this->render('::gallery.html.twig');
    }

    public function contactAction()
    {
        return $this->render('::contact.html.twig');
    }

    public function vetAction()
    {
        return $this->render('::veterinaires.html.twig');
    }

    public function dressAction()
    {
        return $this->render('::dressuer.html.twig');
    }

    public function redirectAction()
    {
        $user=$this->get('security.token_storage')->getToken()->getUser();
        $role=$user->getRoles();

        var_dump($role);


        if ($role[0]=='ROLE_VETE'){

            return $this->redirectToRoute('f_soin_index');
        }
        elseif ($role[0]=='ROLE_DRESS'){
            return $this->redirectToRoute('f_dressage_index');
        }
        else{return $this->redirectToRoute('front_end_homepage');}
    }
}
