<?php

namespace PaperRockSissorsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PaperRockSissorsBundle:Default:index.html.twig');

    }

    public function playAction($state)
    {

    }

}
