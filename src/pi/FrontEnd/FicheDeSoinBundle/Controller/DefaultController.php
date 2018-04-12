<?php

namespace pi\FrontEnd\FicheDeSoinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render(':FrontEnd:layout.html.twig');
    }

<<<<<<< HEAD

=======
    public function notActivedAction()
    {
        return $this->render('@FicheDeSoin/f_soin/404notFound.html.twig');
    }
>>>>>>> aecd55095bfd9a8ec3d097f9c8ac1652a7938404
}
