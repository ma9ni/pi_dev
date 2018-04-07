<?php

namespace pi\FrontEnd\CommercialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CommercialBundle:Default:index.html.twig');
    }
}
