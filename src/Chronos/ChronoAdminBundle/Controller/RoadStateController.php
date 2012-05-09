<?php

namespace Chronos\ChronoAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Chronos\ChronoAdminBundle\Entity\RoadState;
use Chronos\ChronoAdminBundle\Form\RoadStateType;

/**
 * RoadState controller.
 *
 */
class RoadStateController extends Controller
{
    /**
     * Lists all RoadState entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ChronosChronoAdminBundle:RoadState')->findAll();

        return $this->render('ChronosChronoAdminBundle:RoadState:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a RoadState entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChronosChronoAdminBundle:RoadState')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RoadState entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ChronosChronoAdminBundle:RoadState:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new RoadState entity.
     *
     */
    public function newAction()
    {
        $entity = new RoadState();
        $form   = $this->createForm(new RoadStateType(), $entity);

        return $this->render('ChronosChronoAdminBundle:RoadState:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new RoadState entity.
     *
     */
    public function createAction()
    {
        $entity  = new RoadState();
        $request = $this->getRequest();
        $form    = $this->createForm(new RoadStateType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('roadstate_show', array('id' => $entity->getId())));
            
        }

        return $this->render('ChronosChronoAdminBundle:RoadState:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing RoadState entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChronosChronoAdminBundle:RoadState')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RoadState entity.');
        }

        $editForm = $this->createForm(new RoadStateType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ChronosChronoAdminBundle:RoadState:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing RoadState entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChronosChronoAdminBundle:RoadState')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RoadState entity.');
        }

        $editForm   = $this->createForm(new RoadStateType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('roadstate_edit', array('id' => $id)));
        }

        return $this->render('ChronosChronoAdminBundle:RoadState:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a RoadState entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ChronosChronoAdminBundle:RoadState')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find RoadState entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('roadstate'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
