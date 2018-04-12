<?php

namespace pi\FrontEnd\FicheDeSoinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render(':FrontEnd:layout.html.twig');
    }


    public function notActivedAction()
    {
        return $this->render('@FicheDeSoin/f_soin/404notFound.html.twig');
    }
}
