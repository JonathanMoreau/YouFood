<?php

namespace YouFood\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use YouFood\AdminBundle\Entity\Food;
use YouFood\AdminBundle\Form\FoodType;

/**
 * Food controller.
 *
 */
class FoodController extends Controller
{
    /**
     * Lists all Food entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('YouFoodAdminBundle:Food')->findAll();

        return $this->render('YouFoodAdminBundle:Food:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Food entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('YouFoodAdminBundle:Food')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Food entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('YouFoodAdminBundle:Food:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Food entity.
     *
     */
    public function newAction()
    {
        $entity = new Food();
        $form   = $this->createForm(new FoodType(), $entity);

        return $this->render('YouFoodAdminBundle:Food:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Food entity.
     *
     */
    public function createAction()
    {
        $entity  = new Food();
        $request = $this->getRequest();
        $form    = $this->createForm(new FoodType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('food_show', array('id' => $entity->getId())));
            
        }

        return $this->render('YouFoodAdminBundle:Food:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Food entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('YouFoodAdminBundle:Food')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Food entity.');
        }

        $editForm = $this->createForm(new FoodType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('YouFoodAdminBundle:Food:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Food entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('YouFoodAdminBundle:Food')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Food entity.');
        }

        $editForm   = $this->createForm(new FoodType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('food_edit', array('id' => $id)));
        }

        return $this->render('YouFoodAdminBundle:Food:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Food entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('YouFoodAdminBundle:Food')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Food entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('food'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
