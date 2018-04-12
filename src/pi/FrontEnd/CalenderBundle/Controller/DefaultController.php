<?php

namespace pi\FrontEnd\CalenderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CalanderBundle:Default:index.html.twig');
    }
}
