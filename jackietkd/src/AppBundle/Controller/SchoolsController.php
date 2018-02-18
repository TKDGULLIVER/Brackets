<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Schools;
use AppBundle\Form\SchoolsType;

/**
 * Schools controller.
 *
 * @Route("/schools")
 */
class SchoolsController extends Controller
{
    /**
     * Lists all Schools entities.
     *
     * @Route("/", name="schools_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $schools = $em->getRepository('AppBundle:Schools')->findAll();

        return $this->render('schools/index.html.twig', array(
            'schools' => $schools,
        ));
    }

    /**
     * Creates a new Schools entity.
     *
     * @Route("/new", name="schools_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $school = new Schools();
        $form = $this->createForm('AppBundle\Form\SchoolsType', $school);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($school);
            $em->flush();

            return $this->redirectToRoute('schools_show', array('id' => $school->getId()));
        }

        return $this->render('schools/new.html.twig', array(
            'school' => $school,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Schools entity.
     *
     * @Route("/{id}", name="schools_show")
     * @Method("GET")
     */
    public function showAction(Schools $school)
    {
        $deleteForm = $this->createDeleteForm($school);

        return $this->render('schools/show.html.twig', array(
            'school' => $school,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Schools entity.
     *
     * @Route("/{id}/edit", name="schools_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Schools $school)
    {
        $deleteForm = $this->createDeleteForm($school);
        $editForm = $this->createForm('AppBundle\Form\SchoolsType', $school);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($school);
            $em->flush();

            return $this->redirectToRoute('schools_edit', array('id' => $school->getId()));
        }

        return $this->render('schools/edit.html.twig', array(
            'school' => $school,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Schools entity.
     *
     * @Route("/{id}", name="schools_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Schools $school)
    {
        $form = $this->createDeleteForm($school);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($school);
            $em->flush();
        }

        return $this->redirectToRoute('schools_index');
    }

    /**
     * Creates a form to delete a Schools entity.
     *
     * @param Schools $school The Schools entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Schools $school)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('schools_delete', array('id' => $school->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
