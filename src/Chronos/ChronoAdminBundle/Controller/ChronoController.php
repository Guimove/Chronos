<?php

namespace Chronos\ChronoAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Chronos\ChronoAdminBundle\Entity\Chrono;
use Chronos\ChronoAdminBundle\Form\ChronoType;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;

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

        $query = $em->getRepository('ChronosChronoAdminBundle:Chrono')->getAllChronos();

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

        return $this->render('ChronosChronoAdminBundle:Chrono:index.html.twig', array(
            'entities' => $entities,
            'pagerfanta' => $pagerfanta
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

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ChronosChronoAdminBundle:Chrono:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Chrono entity.
     *
     */
    public function newAction()
    {
        $entity = new Chrono();
        $form = $this->createForm(new ChronoType(), $entity);

        return $this->render('ChronosChronoAdminBundle:Chrono:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new Chrono entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Chrono();
        $form = $this->createForm(new ChronoType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('chrono_show', array('id' => $entity->getId())));
        }

        return $this->render('ChronosChronoAdminBundle:Chrono:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Chrono entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChronosChronoAdminBundle:Chrono')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Chrono entity.');
        }

        $editForm = $this->createForm(new ChronoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ChronosChronoAdminBundle:Chrono:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Chrono entity.
     *
     */
    public function updateAction($id, $error = null)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ChronosChronoAdminBundle:Chrono')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Chrono entity.');
        }

        $editForm = $this->createForm(new ChronoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('chrono_edit', array('id' => $id)));
        }

        return $this->render('ChronosChronoAdminBundle:Chrono:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Chrono entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ChronosChronoAdminBundle:Chrono')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Chrono entity.');
            }
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('chrono_index'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}
