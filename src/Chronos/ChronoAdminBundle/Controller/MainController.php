<?php

namespace Chronos\ChronoAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('ChronosChronoAdminBundle:Main:index.html.twig');
    }
}