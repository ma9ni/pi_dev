<?php

namespace pi\FrontEnd\VeterinaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CalenderController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Veterinaire/calendrier.html.twig');
    }




}
