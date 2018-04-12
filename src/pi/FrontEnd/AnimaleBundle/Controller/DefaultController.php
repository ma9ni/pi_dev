<?php

namespace pi\FrontEnd\AnimaleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AnimaleBundle:Default:index.html.twig');
    }



}
