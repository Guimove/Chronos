<?php

namespace Chronos\ChronoAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Chronos\ChronoAdminBundle\Entity\Circuit;
use Chronos\ChronoAdminBundle\Form\CircuitType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;

/**
 * Circuit controller.
 *
 */
class CircuitController extends Controller
{
    /**
     * Lists all Circuit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $query = $em->getRepository('ChronosChronoAdminBundle:Circuit')->getAllCircuit();

        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(20);
        $request = $this->get('request');
        $page = $request->query->get('page', 1);
        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }
        $entities = $pagerfanta->getCurrentPageResults();

        return $this->render('ChronosChronoAdminBundle:Circuit:index.html.twig', array(
            'entities' => $entities,
            'pagerfanta' => $pagerfanta
        ));
    }

    /**
     * Finds and displays a Circuit entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChronosChronoAdminBundle:Circuit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Circuit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ChronosChronoAdminBundle:Circuit:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Circuit entity.
     *
     */
    public function newAction()
    {
        $entity = new Circuit();
        $form   = $this->createForm(new CircuitType(), $entity);

        return $this->render('ChronosChronoAdminBundle:Circuit:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Circuit entity.
     *
     */
    public function createAction()
    {
        $entity  = new Circuit();
        $request = $this->getRequest();
        $form    = $this->createForm(new CircuitType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('circuit_show', array('id' => $entity->getId())));

        }

        return $this->render('ChronosChronoAdminBundle:Circuit:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Circuit entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChronosChronoAdminBundle:Circuit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Circuit entity.');
        }

        $editForm = $this->createForm(new CircuitType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ChronosChronoAdminBundle:Circuit:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Circuit entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChronosChronoAdminBundle:Circuit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Circuit entity.');
        }

        $editForm   = $this->createForm(new CircuitType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('circuit_edit', array('id' => $id)));
        }

        return $this->render('ChronosChronoAdminBundle:Circuit:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Circuit entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ChronosChronoAdminBundle:Circuit')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Circuit entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('circuit_index'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
