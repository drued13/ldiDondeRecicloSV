<?php

namespace Acme\Bundle\DondeRecicloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeDondeRecicloBundle:Default:index.html.twig', array('name' => $name));
    }
}
