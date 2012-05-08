<?php

namespace Chronos\ChronoAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Chronos\ChronoAdminBundle\Entity\Weather;

/**
 * Weather controller.
 *
 */
class WeatherController extends Controller
{
    /**
     * Lists all Weather entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ChronosChronoAdminBundle:Weather')->findAll();

        return $this->render('ChronosChronoAdminBundle:Weather:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Weather entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChronosChronoAdminBundle:Weather')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Weather entity.');
        }

        return $this->render('ChronosChronoAdminBundle:Weather:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

}
