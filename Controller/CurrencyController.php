<?php

namespace Qwer\LottoClientBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Qwer\LottoClientBundle\Entity\Currency;
use Qwer\LottoClientBundle\Form\CurrencyType;

/**
 * Currency controller.
 *
 */
class CurrencyController extends Controller
{
    /**
     * Lists all Currency entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('QwerLottoClientBundle:Currency')->findAll();

        return $this->render('QwerLottoClientBundle:Currency:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Currency entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Currency();
        $form = $this->createForm(new CurrencyType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('currency_show', array('id' => $entity->getId())));
        }

        return $this->render('QwerLottoClientBundle:Currency:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Currency entity.
     *
     */
    public function newAction()
    {
        $entity = new Currency();
        $form   = $this->createForm(new CurrencyType(), $entity);

        return $this->render('QwerLottoClientBundle:Currency:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Currency entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QwerLottoClientBundle:Currency')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Currency entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('QwerLottoClientBundle:Currency:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Currency entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QwerLottoClientBundle:Currency')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Currency entity.');
        }

        $editForm = $this->createForm(new CurrencyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('QwerLottoClientBundle:Currency:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Currency entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('QwerLottoClientBundle:Currency')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Currency entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CurrencyType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('currency_edit', array('id' => $id)));
        }

        return $this->render('QwerLottoClientBundle:Currency:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Currency entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('QwerLottoClientBundle:Currency')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Currency entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('currency'));
    }

    /**
     * Creates a form to delete a Currency entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
