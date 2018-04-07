<?php

namespace pi\BackEnd\CommercialAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CommercialAdminBundle:Default:index.html.twig');
    }
}
