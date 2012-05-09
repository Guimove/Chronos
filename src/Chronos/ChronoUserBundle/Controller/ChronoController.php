<?php

namespace Chronos\ChronoUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Chronos\ChronoAdminBundle\Entity\Chrono;

/**
 * Chrono controller.
 *
 */
class ChronoController extends Controller
{
    /**
     * Lists all Chrono entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ChronosChronoAdminBundle:Chrono')->findAll();

        return $this->render('ChronosChronoUserBundle:Chrono:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Chrono entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChronosChronoAdminBundle:Chrono')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Chrono entity.');
        }

        return $this->render('ChronosChronoUserBundle:Chrono:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

}
