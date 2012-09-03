<?php

namespace YouFood\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use YouFood\AdminBundle\Entity\FoodCategory;
use YouFood\AdminBundle\Form\FoodCategoryType;

/**
 * FoodCategory controller.
 *
 */
class FoodCategoryController extends Controller
{
    /**
     * Lists all FoodCategory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('YouFoodAdminBundle:FoodCategory')->findAll();

        return $this->render('YouFoodAdminBundle:FoodCategory:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a FoodCategory entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('YouFoodAdminBundle:FoodCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FoodCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('YouFoodAdminBundle:FoodCategory:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new FoodCategory entity.
     *
     */
    public function newAction()
    {
        $entity = new FoodCategory();
        $form   = $this->createForm(new FoodCategoryType(), $entity);

        return $this->render('YouFoodAdminBundle:FoodCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new FoodCategory entity.
     *
     */
    public function createAction()
    {
        $entity  = new FoodCategory();
        $request = $this->getRequest();
        $form    = $this->createForm(new FoodCategoryType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('foodcategory_show', array('id' => $entity->getId())));
            
        }

        return $this->render('YouFoodAdminBundle:FoodCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing FoodCategory entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('YouFoodAdminBundle:FoodCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FoodCategory entity.');
        }

        $editForm = $this->createForm(new FoodCategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('YouFoodAdminBundle:FoodCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing FoodCategory entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('YouFoodAdminBundle:FoodCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FoodCategory entity.');
        }

        $editForm   = $this->createForm(new FoodCategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('foodcategory_edit', array('id' => $id)));
        }

        return $this->render('YouFoodAdminBundle:FoodCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a FoodCategory entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('YouFoodAdminBundle:FoodCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FoodCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('foodcategory'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
