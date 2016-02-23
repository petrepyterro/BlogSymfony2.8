<?php

namespace BlogBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
/**
 * Page controller.
 *
 * @Route("/")
 */
class PageController extends Controller{
    
  /**
    * Lists all Blog entities.
    *
    * @Route("/", name="homepage")
    * @Method("GET")
  */
  public function indexAction(){
    $em = $this->getDoctrine()->getManager();
    
    $blogs = $em->getRepository('BlogBundle:Blog')->getLatestBlogs();
    
    return $this->render('BlogBundle:Page:index.html.twig', array('blogs' => $blogs));
  }
  
  /**
    *
    * @Route("/about", name="about")
    * @Method("GET")
  */
  public function aboutAction(){
    return $this->render('BlogBundle:Page:about.html.twig');
  }
  
  /**
    *
    * @Route("/sidebar", name="sidebar")
    * @Method("GET")
  */
  public function sidebarAction(){
    $em = $this->getDoctrine()->getManager();
    
    $tags = $em->getRepository('BlogBundle:Blog')->getTags();
    
    $tagWeights = $em->getRepository('BlogBundle:Blog')->getTagWeights($tags);
    
    $commentLimit = $this->container->getParameter('blog.comments.latest_comment_limit');
    $latestComments = $em->getRepository('BlogBundle:Comment')->getLatestComments($commentLimit);
    
    return $this->render('BlogBundle:Page:sidebar.html.twig', array(
      'latestComments' => $latestComments,  
      'tags' => $tagWeights
    ));
  }
}