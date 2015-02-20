<?php

namespace Ink\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('InkGeneralBundle:Default:index.html.twig');
    }
}
