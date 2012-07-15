<?php

namespace Chronos\ChronoAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Chronos\ChronoAdminBundle\Entity\Weather;
use Chronos\ChronoAdminBundle\Form\WeatherType;

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

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ChronosChronoAdminBundle:Weather:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Weather entity.
     *
     */
    public function newAction()
    {
        $entity = new Weather();
        $form   = $this->createForm(new WeatherType(), $entity);

        return $this->render('ChronosChronoAdminBundle:Weather:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Weather entity.
     *
     */
    public function createAction()
    {
        $entity  = new Weather();
        $request = $this->getRequest();
        $form    = $this->createForm(new WeatherType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('weather_show', array('id' => $entity->getId())));

        }

        return $this->render('ChronosChronoAdminBundle:Weather:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Weather entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChronosChronoAdminBundle:Weather')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Weather entity.');
        }

        $editForm = $this->createForm(new WeatherType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ChronosChronoAdminBundle:Weather:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Weather entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChronosChronoAdminBundle:Weather')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Weather entity.');
        }

        $editForm   = $this->createForm(new WeatherType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('weather_edit', array('id' => $id)));
        }

        return $this->render('ChronosChronoAdminBundle:Weather:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Weather entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ChronosChronoAdminBundle:Weather')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Weather entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('weather'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
