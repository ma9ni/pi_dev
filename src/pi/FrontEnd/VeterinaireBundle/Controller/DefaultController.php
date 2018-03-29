<?php

namespace pi\FrontEnd\VeterinaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VeterinaireBundle:Default:index.html.twig');
    }
}
