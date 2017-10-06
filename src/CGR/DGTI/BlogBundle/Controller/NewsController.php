<?php

namespace CGR\DGTI\BlogBundle\Controller;

use CGR\DGTI\BlogBundle\Entity\News;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * News controller.
 *
 * @Route("news")
 */
class NewsController extends Controller {

    /**
     * Lists all news entities.
     *
     * @Route("/", name="news_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $news = $em->getRepository('BlogBundle:News')->findBy(array('publicado' => false, 'usuarioInsert' => $user)); //->findByUsuarioInsert($user);

        return $this->render('news/index.html.twig', array(
                    'news' => $news,
                    'user' => $user,
        ));
    }

    /**
     * Creates a new news entity.
     *
     * @Route("/new", name="news_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $news = new News();
        $form = $this->createForm('CGR\DGTI\BlogBundle\Form\NewsType', $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $image = $news->getImagen();
            $imageName = md5(uniqid()) . '.' . $image->guessExtension();

            $image->move(
                    $this->getParameter('image_directory'), $imageName
            );

            $news->setImagen($imageName);

            $user = $this->getUser();
            $news->setUsuarioInsert($user);
            $news->setUsuarioUpdate(null);
            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('news_show', array('id' => $news->getId()));
        }

        return $this->render('news/new.html.twig', array(
                    'news' => $news,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a news entity.
     *
     * @Route("/{id}", name="news_show")
     * @Method("GET")
     */
    public function showAction(News $news) {
        $deleteForm = $this->createDeleteForm($news);

        return $this->render('news/show.html.twig', array(
                    'news' => $news,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing news entity.
     *
     * @Route("/{id}/edit", name="news_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, News $news) {
        $deleteForm = $this->createDeleteForm($news);
        $editForm = $this->createForm('CGR\DGTI\BlogBundle\Form\NewsType', $news);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $user = $this->getUser();
            $news->setUsuarioUpdate($user);


            $news->setUsuarioUpdate($user);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('news_edit', array('id' => $news->getId()));
        }

        return $this->render('news/edit.html.twig', array(
                    'news' => $news,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a news entity.
     *
     * @Route("/{id}", name="news_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, News $news) {
        $form = $this->createDeleteForm($news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($news);
            $em->flush();
        }

        return $this->redirectToRoute('news_index');
    }

    /**
     * Creates a form to delete a news entity.
     *
     * @param News $news The news entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(News $news) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('news_delete', array('id' => $news->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }
    
    /**
     * 
     * @Route("/news/mail/{name}", defaults={"name"=NULL}, name="news_sendEmail")
     */

    public function sendMailAction($name) {

        dump($name);

        $mailer = $this->get('mailer');

        $message = (new \Swift_Message('Hello Moto'))
            ->setFrom($name)
            ->setTo($name)
            ->setBody('Agarrate que te voy a dar duro'
            //$this->renderView('Emails/registration.html.twig',array('name'=>$name), 'text/html')
        );

        dump($message);

        $mailer->send($message);
        
        return $this->render('news/mail.html.twig');
    }
    
    /**
     * Connection
     *
     * @Route("/log_ldap", name="log_ldap")
     */
    public function logLdapAction() {
        return new Response('<html><body>Vista de Login</body></html>');
    }

}
