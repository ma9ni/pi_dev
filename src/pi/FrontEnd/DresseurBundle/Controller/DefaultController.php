<?php

namespace pi\FrontEnd\DresseurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DresseurBundle:Default:index.html.twig');
    }
}
