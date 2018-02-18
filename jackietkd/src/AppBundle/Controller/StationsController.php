<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Stations;
use AppBundle\Form\StationsType;

/**
 * Stations controller.
 *
 * @Route("/stations")
 */
class StationsController extends Controller
{
    /**
     * Lists all Stations entities.
     *
     * @Route("/", name="stations_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stations = $em->getRepository('AppBundle:Stations')->findAll();

        return $this->render('stations/index.html.twig', array(
            'stations' => $stations,
        ));
    }

    /**
     * Creates a new Stations entity.
     *
     * @Route("/new", name="stations_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $station = new Stations();
        $form = $this->createForm('AppBundle\Form\StationsType', $station);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($station);
            $em->flush();

            return $this->redirectToRoute('stations_show', array('id' => $station->getId()));
        }

        return $this->render('stations/new.html.twig', array(
            'station' => $station,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Stations entity.
     *
     * @Route("/{id}", name="stations_show")
     * @Method("GET")
     */
    public function showAction(Stations $station)
    {
        $deleteForm = $this->createDeleteForm($station);

        return $this->render('stations/show.html.twig', array(
            'station' => $station,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Stations entity.
     *
     * @Route("/{id}/edit", name="stations_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Stations $station)
    {
        $deleteForm = $this->createDeleteForm($station);
        $editForm = $this->createForm('AppBundle\Form\StationsType', $station);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($station);
            $em->flush();

            return $this->redirectToRoute('stations_edit', array('id' => $station->getId()));
        }

        return $this->render('stations/edit.html.twig', array(
            'station' => $station,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Stations entity.
     *
     * @Route("/{id}", name="stations_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Stations $station)
    {
        $form = $this->createDeleteForm($station);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($station);
            $em->flush();
        }

        return $this->redirectToRoute('stations_index');
    }

    /**
     * Creates a form to delete a Stations entity.
     *
     * @param Stations $station The Stations entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Stations $station)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stations_delete', array('id' => $station->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
