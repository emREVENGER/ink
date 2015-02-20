<?php

namespace Ink\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('InkUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
