<?php

namespace pi\FrontEnd\FicheDeDressageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render(':FrontEnd:layout.html.twig');
    }

    public function aboutAction()
    {
        return $this->render(':FrontEnd:about.html.twig');
    }

    public function galleryAction()
    {
        return $this->render(':FrontEnd:gallery.html.twig');
    }

    public function contactAction()
    {
        return $this->render(':FrontEnd:contact.html.twig');
    }



    public function dressAction()
    {
        return $this->render(':FrontEnd:dressuer.html.twig');
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
