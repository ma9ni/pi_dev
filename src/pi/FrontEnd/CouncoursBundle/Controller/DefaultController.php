<?php

namespace pi\FrontEnd\CouncoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ConcoursBundle:Default:index.html.twig');
    }
}
