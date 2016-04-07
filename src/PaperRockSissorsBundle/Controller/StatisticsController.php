<?php

namespace PaperRockSissorsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PaperRockSissorsBundle\Entity\Statistics;
use PaperRockSissorsBundle\Form\StatisticsType;

/**
 * Statistics controller.
 *
 */
class StatisticsController extends Controller
{
    /**
     * Lists all Statistics entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $statistics = $em->getRepository('PaperRockSissorsBundle:Statistics')->findAll();

        return $this->render('statistics/index.html.twig', array(
            'statistics' => $statistics,
        ));
    }

    /**
     * Creates a new Statistics entity.
     *
     */
    public function newAction(Request $request)
    {
        $statistic = new Statistics();
        $form = $this->createForm('PaperRockSissorsBundle\Form\StatisticsType', $statistic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($statistic);
            $em->flush();

            return $this->redirectToRoute('statistics_show', array('id' => $statistic->getId()));
        }

        return $this->render('statistics/new.html.twig', array(
            'statistic' => $statistic,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Statistics entity.
     *
     */
    public function showAction(Statistics $statistic)
    {
        $deleteForm = $this->createDeleteForm($statistic);

        return $this->render('statistics/show.html.twig', array(
            'statistic' => $statistic,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Statistics entity.
     *
     */
    public function editAction(Request $request, Statistics $statistic)
    {
        $deleteForm = $this->createDeleteForm($statistic);
        $editForm = $this->createForm('PaperRockSissorsBundle\Form\StatisticsType', $statistic);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($statistic);
            $em->flush();

            return $this->redirectToRoute('statistics_edit', array('id' => $statistic->getId()));
        }

        return $this->render('statistics/edit.html.twig', array(
            'statistic' => $statistic,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Statistics entity.
     *
     */
    public function deleteAction(Request $request, Statistics $statistic)
    {
        $form = $this->createDeleteForm($statistic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($statistic);
            $em->flush();
        }

        return $this->redirectToRoute('statistics_index');
    }

    /**
     * Creates a form to delete a Statistics entity.
     *
     * @param Statistics $statistic The Statistics entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Statistics $statistic)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('statistics_delete', array('id' => $statistic->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
