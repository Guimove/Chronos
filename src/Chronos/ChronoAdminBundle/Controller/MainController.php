<?php

namespace Chronos\ChronoAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Chronos\ChronoAdminBundle\Entity\Chrono;
use Chronos\ChronoAdminBundle\Form\ChronoType;

class MainController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ChronosChronoAdminBundle:Chrono');

        $query = $entities->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(20)
            ->getQuery();

        $products = $query->getResult();

        return $this->render('ChronosChronoAdminBundle:Main:index.html.twig', array(
                    'entities' => $products,
                    'user' => $user,
                ));
    }
}