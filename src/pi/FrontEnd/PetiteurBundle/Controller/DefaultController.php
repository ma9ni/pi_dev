<?php

namespace pi\FrontEnd\PetiteurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PetiteurBundle:Default:index.html.twig');
    }
}
