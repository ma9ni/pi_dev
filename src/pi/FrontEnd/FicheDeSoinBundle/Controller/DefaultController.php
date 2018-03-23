<?php

namespace pi\FrontEnd\FicheDeSoinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('::layout.html.twig');
    }
}
