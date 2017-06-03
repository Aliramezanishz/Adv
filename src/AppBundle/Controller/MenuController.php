<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Adv;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MenuController extends Controller {

    /**
     * @Template
     * @Route("/menu/categorie", name="menu_categorie")
     */ 
public function categorieAction()
{
    $em = $this->getDoctrine()->getManager();

    $categories = $em->getRepository('AppBundle:categorie')->findAll();
    
    $Locations = $em->getRepository('AppBundle:Location')->findAll();
    return $this->render('AppBundle:categorie:menu.html.twig', array(
        'categories' => $categories,
        'Locations' => $Locations
    ));
}



    
}
