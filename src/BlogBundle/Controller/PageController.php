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
      return $this->render('BlogBundle:Page:index.html.twig');
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