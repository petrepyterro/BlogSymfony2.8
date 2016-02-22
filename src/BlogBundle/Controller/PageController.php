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
    
    $blogs = $em->createQueryBuilder()
      ->select('b')
      ->from('BlogBundle:Blog', 'b')
      ->addOrderBy('b.created', 'DESC')
      ->getQuery()->getResult();
    
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
}