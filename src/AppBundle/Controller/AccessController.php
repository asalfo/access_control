<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Access;
use AppBundle\Form\AccessType;

/**
 * Access controller.
 *
 * @Route("/access")
 */
class AccessController extends Controller
{

    /**
     * Lists all Access entities.
     *
     * @Route("/", name="access")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $accesses = $em->getRepository('AppBundle:Access')->findTodayAccesses();

        return array(
            'entities' => $accesses,
        );
    }
    /**
     * Creates a new Access entity.
     *
     * @Route("/", name="access_create")
     * @Method("POST")
     * @Template("AppBundle:Access:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Access();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('access_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Access entity.
     *
     * @param Access $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Access $entity)
    {
        $form = $this->createForm(new AccessType(), $entity, array(
            'action' => $this->generateUrl('access_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Access entity.
     *
     * @Route("/new", name="access_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Access();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Access entity.
     *
     * @Route("/{id}", name="access_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Access')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Access entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Access entity.
     *
     * @Route("/{id}/edit", name="access_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Access')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Access entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Access entity.
    *
    * @param Access $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Access $entity)
    {
        $form = $this->createForm(new AccessType(), $entity, array(
            'action' => $this->generateUrl('access_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Access entity.
     *
     * @Route("/{id}", name="access_update")
     * @Method("PUT")
     * @Template("AppBundle:Access:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Access')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Access entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('access_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Access entity.
     *
     * @Route("/{id}", name="access_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Access')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Access entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('access'));
    }

    /**
     * Creates a form to delete a Access entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('access_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
