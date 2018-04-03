<?php

namespace pi\FrontEnd\AdoptionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdoptionBundle:Default:index.html.twig');
    }
}
