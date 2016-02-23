<?php

namespace BlogBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BlogBundle\Entity\Comment;
/**
 * Comment controller.
 *
 * @Route("/comment/{blog_id}")
 */
class CommentController extends Controller{
  
  /**
   * Creates a new Comment entity.
   *
   * @Route("/new", name="comment_new")
   * @Method({"GET", "POST"})
   */
  public function newAction(Request $request)
  {
    $blog_id = $request->get('blog_id');
    $blog = $this->getBlog($blog_id);
    $comment = new Comment();
    $comment->setBlog($blog);
    $form = $this->createForm('BlogBundle\Form\CommentType', $comment, array(
      'action' => $this->generateUrl('comment_new', array(
        'blog_id' => $blog_id
      ))
    ));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($comment);
      $em->flush();
      return $this->
        redirect($this->generateUrl('blog_show', array(
          'id' => $blog_id,
          'slug' => $blog->slug
        )).'#comment-'.$comment->getId());
    }
    return $this->render('BlogBundle:Comment:new.html.twig', array(
      'comment' => $comment,
      'form' => $form->createView(),
    ));
  }
  
  protected function getBlog($blog_id){
    $em = $this->getDoctrine()->getManager();
    
    $blog = $em->getRepository('BlogBundle:Blog')->find($blog_id);
    
    if(!$blog){
      throw new $this->createNotFoundException('Unable to find Blog post');
    }
    
    return $blog;
  }
}