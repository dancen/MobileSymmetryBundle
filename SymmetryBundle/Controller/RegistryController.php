<?php

namespace Mobile\SymmetryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Mobile\SymmetryBundle\Entity\Registry;
use Mobile\SymmetryBundle\Form\RegistryType;

/**
 * Registry controller.
 *
 */
class RegistryController extends Controller
{
    /**
     * Lists all Registry entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('MobileSymmetryBundle:Registry')->findAll();

        return $this->render('MobileSymmetryBundle:Registry:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Registry entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('MobileSymmetryBundle:Registry')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Registry entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MobileSymmetryBundle:Registry:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Registry entity.
     *
     */
    public function newAction()
    {
        $entity = new Registry();
        $form   = $this->createForm(new RegistryType(), $entity);

        return $this->render('MobileSymmetryBundle:Registry:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Registry entity.
     *
     */
    public function createAction()
    {
        $entity  = new Registry();
        $request = $this->getRequest();
        $form    = $this->createForm(new RegistryType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('symmetry_registry_show', array('id' => $entity->getId())));
            
        }

        return $this->render('MobileSymmetryBundle:Registry:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Registry entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('MobileSymmetryBundle:Registry')->find($id);
        

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Registry entity.');
        }

        $editForm = $this->createForm(new RegistryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MobileSymmetryBundle:Registry:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Registry entity.
     *
     */
    public function updateAction($id)
    {
        
        
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('MobileSymmetryBundle:Registry')->find($id);
        

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Registry entity.');
        }

        $editForm   = $this->createForm(new RegistryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $entity->setUpdatedAt(new \Datetime("now"));
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('symmetry_registry_edit', array('id' => $id)));
        }

        return $this->render('MobileSymmetryBundle:Registry:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Registry entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('MobileSymmetryBundle:Registry')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Registry entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('symmetry_registry'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
