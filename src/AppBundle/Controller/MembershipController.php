<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Membership;
use AppBundle\Form\MembershipType;

/**
 * Membership controller.
 *
 * @Route("/membership")
 */
class MembershipController extends Controller
{

    /**
     * Lists all Membership entities.
     *
     * @Route("/", name="membership")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Membership')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Membership entity.
     *
     * @Route("/", name="membership_create")
     * @Method("POST")
     * @Template("AppBundle:Membership:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Membership();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('client_edit', array('id' => $entity->getClient()->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Membership entity.
     *
     * @param Membership $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Membership $entity)
    {
        $form = $this->createForm(new MembershipType(), $entity, array(
            'action' => $this->generateUrl('membership_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Membership entity.
     *
     * @Route("/new", name="membership_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Membership();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Membership entity.
     *
     * @Route("/{id}", name="membership_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Membership')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Membership entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Membership entity.
     *
     * @Route("/{id}/edit", name="membership_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Membership')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Membership entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Membership entity.
    *
    * @param Membership $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Membership $entity)
    {
        $form = $this->createForm(new MembershipType(), $entity, array(
            'action' => $this->generateUrl('membership_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Membership entity.
     *
     * @Route("/{id}", name="membership_update")
     * @Method("POST")
     * @Template("AppBundle:Membership:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Membership')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Membership entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('client_edit', array('id' => $entity->getClient()->getId())).'#suscripciones');
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Membership entity.
     *
     * @Route("/{id}", name="membership_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Membership')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Membership entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('membership'));
    }

    /**
     * Creates a form to delete a Membership entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('membership_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Finds and displays a Membership entity.
     *
     * @Route("/member/data", name="membership_data")
     * @Method("POST")
     * @Template()
     */
    public function dataAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $card = $request->request->get('cardNumber');
        $entity = $em->getRepository('AppBundle:Membership')->findOneByCardNumber($card);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Membership entity.');
        }


        return array(
            'entity'      => $entity,
        );
    }
}
