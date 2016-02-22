<?php

namespace BlogBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BlogBundle\Entity\Blog;
/**
 * Page controller.
 *
 * @Route("/blog")
 */
class BlogController extends Controller{
  /**
   * Finds and displays a blog entity.
   *
   * @Route("/{id}", name="blog_show")
   * @Method("GET")
   */
  public function showAction(Blog $blog)
  {
    $em = $this->getDoctrine()->getManager();
    
    $comments = $em->getRepository('BlogBundle:Comment')->getCommentsForBlog($blog->getId());
    
    return $this->render('BlogBundle:Blog:show.html.twig', array(
      'blog' => $blog,
      'comments' => $comments
    ));
  }
}
