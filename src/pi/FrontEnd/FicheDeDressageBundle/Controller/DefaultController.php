<?php

namespace pi\FrontEnd\FicheDeDressageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('::layout.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('::about.html.twig');
    }

    public function galleryAction()
    {
        return $this->render('::gallery.html.twig');
    }

    public function contactAction()
    {
        return $this->render('::contact.html.twig');
    }

    public function vetAction()
    {
        return $this->render('::veterinaires.html.twig');
    }

    public function dressAction()
    {
        return $this->render('::dressuer.html.twig');
    }
}
