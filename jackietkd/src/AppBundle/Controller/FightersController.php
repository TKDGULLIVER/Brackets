<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Fighters;
use AppBundle\Form\FightersType;

/**
 * Fighters controller.
 *
 * @Route("/fighters")
 */
class FightersController extends Controller
{
    /**
     * Lists all Fighters entities.
     *
     * @Route("/", name="fighters_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fighters = $em->getRepository('AppBundle:Fighters')->findAll();

        return $this->render('fighters/index.html.twig', array(
            'fighters' => $fighters,
        ));
    }

    /**
     * Creates a new Fighters entity.
     *
     * @Route("/new", name="fighters_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fighter = new Fighters();
        $form = $this->createForm('AppBundle\Form\FightersType', $fighter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fighter);
            $em->flush();

            return $this->redirectToRoute('fighters_show', array('id' => $fighter->getId()));
        }

        return $this->render('fighters/new.html.twig', array(
            'fighter' => $fighter,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Fighters entity.
     *
     * @Route("/{id}", name="fighters_show")
     * @Method("GET")
     */
    public function showAction(Fighters $fighter)
    {
        $deleteForm = $this->createDeleteForm($fighter);

        return $this->render('fighters/show.html.twig', array(
            'fighter' => $fighter,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Fighters entity.
     *
     * @Route("/{id}/edit", name="fighters_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Fighters $fighter)
    {
        $deleteForm = $this->createDeleteForm($fighter);
        $editForm = $this->createForm('AppBundle\Form\FightersType', $fighter);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fighter);
            $em->flush();

            return $this->redirectToRoute('fighters_edit', array('id' => $fighter->getId()));
        }

        return $this->render('fighters/edit.html.twig', array(
            'fighter' => $fighter,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Fighters entity.
     *
     * @Route("/{id}", name="fighters_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Fighters $fighter)
    {
        $form = $this->createDeleteForm($fighter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fighter);
            $em->flush();
        }

        return $this->redirectToRoute('fighters_index');
    }

    /**
     * Creates a form to delete a Fighters entity.
     *
     * @param Fighters $fighter The Fighters entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fighters $fighter)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fighters_delete', array('id' => $fighter->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
