<?php

namespace CGR\DGTI\BlogBundle\Controller;

use CGR\DGTI\BlogBundle\Entity\TipoContenido;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tipocontenido controller.
 *
 * @Route("tipocontenido")
 */
class TipoContenidoController extends Controller
{
    /**
     * Lists all tipoContenido entities.
     *
     * @Route("/", name="tipocontenido_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipoContenidos = $em->getRepository('BlogBundle:TipoContenido')->findAll();

        return $this->render('tipocontenido/index.html.twig', array(
            'tipoContenidos' => $tipoContenidos,
        ));
    }

    /**
     * Creates a new tipoContenido entity.
     *
     * @Route("/new", name="tipocontenido_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tipoContenido = new Tipocontenido();
        $form = $this->createForm('CGR\DGTI\BlogBundle\Form\TipoContenidoType', $tipoContenido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoContenido);
            $em->flush();

            return $this->redirectToRoute('tipocontenido_show', array('id' => $tipoContenido->getId()));
        }

        return $this->render('tipocontenido/new.html.twig', array(
            'tipoContenido' => $tipoContenido,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tipoContenido entity.
     *
     * @Route("/{id}", name="tipocontenido_show")
     * @Method("GET")
     */
    public function showAction(TipoContenido $tipoContenido)
    {
        $deleteForm = $this->createDeleteForm($tipoContenido);

        return $this->render('tipocontenido/show.html.twig', array(
            'tipoContenido' => $tipoContenido,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tipoContenido entity.
     *
     * @Route("/{id}/edit", name="tipocontenido_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TipoContenido $tipoContenido)
    {
        $deleteForm = $this->createDeleteForm($tipoContenido);
        $editForm = $this->createForm('CGR\DGTI\BlogBundle\Form\TipoContenidoType', $tipoContenido);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipocontenido_edit', array('id' => $tipoContenido->getId()));
        }

        return $this->render('tipocontenido/edit.html.twig', array(
            'tipoContenido' => $tipoContenido,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tipoContenido entity.
     *
     * @Route("/{id}", name="tipocontenido_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TipoContenido $tipoContenido)
    {
        $form = $this->createDeleteForm($tipoContenido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipoContenido);
            $em->flush();
        }

        return $this->redirectToRoute('tipocontenido_index');
    }

    /**
     * Creates a form to delete a tipoContenido entity.
     *
     * @param TipoContenido $tipoContenido The tipoContenido entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TipoContenido $tipoContenido)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipocontenido_delete', array('id' => $tipoContenido->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
