<?php

namespace pi\BackEnd\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Admin/wrapper.html.twig');
    }


}
