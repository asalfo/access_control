<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Access;

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

        $entities = $em->getRepository('AppBundle:Access')->findAll();

        return array(
            'entities' => $entities,
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

        return array(
            'entity'      => $entity,
        );
    }
}
