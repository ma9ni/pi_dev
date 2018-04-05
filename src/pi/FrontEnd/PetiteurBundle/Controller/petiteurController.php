<?php

namespace pi\FrontEnd\PetiteurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class petiteurController extends Controller
{
    public function indexAction()
    {
        return $this->render('PetiteurBundle:petiteur:index.html.twig');
    }

}
