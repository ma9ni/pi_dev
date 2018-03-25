<?php

namespace pi\FrontEnd\FicheDeDressageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FicheDeDressageBundle:Default:index.html.twig');
    }
}
