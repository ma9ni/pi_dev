<?php

namespace pi\FrontEnd\FicheDeDressageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class f_dressageController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
