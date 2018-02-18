<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Ranks;
use AppBundle\Form\RanksType;

/**
 * Ranks controller.
 *
 * @Route("/ranks")
 */
class RanksController extends Controller
{
    /**
     * Lists all Ranks entities.
     *
     * @Route("/", name="ranks_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ranks = $em->getRepository('AppBundle:Ranks')->findAll();

        return $this->render('ranks/index.html.twig', array(
            'ranks' => $ranks,
        ));
    }

    /**
     * Creates a new Ranks entity.
     *
     * @Route("/new", name="ranks_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rank = new Ranks();
        $form = $this->createForm('AppBundle\Form\RanksType', $rank);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rank);
            $em->flush();

            return $this->redirectToRoute('ranks_show', array('id' => $rank->getId()));
        }

        return $this->render('ranks/new.html.twig', array(
            'rank' => $rank,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Ranks entity.
     *
     * @Route("/{id}", name="ranks_show")
     * @Method("GET")
     */
    public function showAction(Ranks $rank)
    {
        $deleteForm = $this->createDeleteForm($rank);

        return $this->render('ranks/show.html.twig', array(
            'rank' => $rank,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Ranks entity.
     *
     * @Route("/{id}/edit", name="ranks_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Ranks $rank)
    {
        $deleteForm = $this->createDeleteForm($rank);
        $editForm = $this->createForm('AppBundle\Form\RanksType', $rank);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rank);
            $em->flush();

            return $this->redirectToRoute('ranks_edit', array('id' => $rank->getId()));
        }

        return $this->render('ranks/edit.html.twig', array(
            'rank' => $rank,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Ranks entity.
     *
     * @Route("/{id}", name="ranks_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Ranks $rank)
    {
        $form = $this->createDeleteForm($rank);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rank);
            $em->flush();
        }

        return $this->redirectToRoute('ranks_index');
    }

    /**
     * Creates a form to delete a Ranks entity.
     *
     * @param Ranks $rank The Ranks entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ranks $rank)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ranks_delete', array('id' => $rank->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
