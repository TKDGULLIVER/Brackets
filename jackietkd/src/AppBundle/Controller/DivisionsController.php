<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Divisions;
use AppBundle\Form\DivisionsType;

/**
 * Divisions controller.
 *
 * @Route("/divisions")
 */
class DivisionsController extends Controller
{
    /**
     * Lists all Divisions entities.
     *
     * @Route("/", name="divisions_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $divisions = $em->getRepository('AppBundle:Divisions')->findAll();

        return $this->render('divisions/index.html.twig', array(
            'divisions' => $divisions,
        ));
    }

    /**
     * Creates a new Divisions entity.
     *
     * @Route("/new", name="divisions_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $division = new Divisions();
        $form = $this->createForm('AppBundle\Form\DivisionsType', $division);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($division);
            $em->flush();

            return $this->redirectToRoute('divisions_show', array('id' => $division->getId()));
        }

        return $this->render('divisions/new.html.twig', array(
            'division' => $division,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Divisions entity.
     *
     * @Route("/{id}", name="divisions_show")
     * @Method("GET")
     */
    public function showAction(Divisions $division)
    {
        $deleteForm = $this->createDeleteForm($division);

        return $this->render('divisions/show.html.twig', array(
            'division' => $division,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Divisions entity.
     *
     * @Route("/{id}/edit", name="divisions_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Divisions $division)
    {
        $deleteForm = $this->createDeleteForm($division);
        $editForm = $this->createForm('AppBundle\Form\DivisionsType', $division);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($division);
            $em->flush();

            return $this->redirectToRoute('divisions_edit', array('id' => $division->getId()));
        }

        return $this->render('divisions/edit.html.twig', array(
            'division' => $division,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Divisions entity.
     *
     * @Route("/{id}", name="divisions_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Divisions $division)
    {
        $form = $this->createDeleteForm($division);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($division);
            $em->flush();
        }

        return $this->redirectToRoute('divisions_index');
    }

    /**
     * Creates a form to delete a Divisions entity.
     *
     * @param Divisions $division The Divisions entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Divisions $division)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('divisions_delete', array('id' => $division->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
