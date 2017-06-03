<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Adv;
use AppBundle\Entity\categorie;
use AppBundle\Entity\Location;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function newAction(Request $request) {
        $adv = new Adv();
        $form = $this->createForm(\AppBundle\Form\AdvType::class, $adv);
        $form->handleRequest($request);
        // replace this example code with whatever you need
        if ($form->isSubmitted() && $form->isValid()) {


            // $file stores the uploaded jpeg file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $adv->getPic();


            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();


            ////////////////////send Name file to database////////////////////////////////



            $adv->setPic($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($adv);

            $em->flush();



            // Move the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('adv_directory'), $fileName
            );

            // Update the 'brochure' property to store the jepeg file name
            // instead of its contents
            $adv->setPic($fileName);
            $adv->setName($adv->getName());

            // ... persist the $product variable or any other work

            return $this->redirect($this->generateUrl('new'));
        }
        return $this->render('default/new.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    /**
     * @Route("/display", name="app_display")
     */
    public function showAction(Request $request) {
        $adv = new \AppBundle\Entity\Adv();
        $em = $this->getDoctrine()->getManager();
        $adv_repository = $em->getRepository('AppBundle:Adv')->findAll();


        return $this->render(
                        'default/display.html.twig', array(
                    'advs' => $adv_repository,)
        );
    }

    /**
     * @Route("/display/details/{id}", name="app_display_details")
     * @ParamConverter("adv", class="AppBundle:Adv")
     */
    public function showDetailsAction(Adv $adv, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $comment_repository = $em->getRepository('AppBundle:Comment')->findBy(['Adv' => $adv]);
        $form = $this->createForm(\AppBundle\Form\CommentType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setAdv($adv);
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('app_display_details',['id' => $adv->getId()]);
        }

        return $this->render(
                        'default/displayDetails.html.twig', array(
                    'adv' => $adv, 'form' => $form->createView(), 'comments' => $comment_repository)
        );
    }

    /**
     * @Route("/display/Categories/{id}", name="app_display_Categories")
     * @ParamConverter("categorie", class="AppBundle:categorie")
     */
    public function showCatAction(categorie $categorie, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $adv_repository = $em->getRepository('AppBundle:Adv')->findBy(['categorie' => $categorie]);
       
        return $this->render(
                        'default/display.html.twig', array(
                    'advs' => $adv_repository,)
        );
    }
    
    /**
     * @Route("/display/location/{id}", name="app_display_Location")
     * @ParamConverter("Location", class="AppBundle:Location")
     */
    public function showLocAction(Location $Location, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $adv_repository = $em->getRepository('AppBundle:Adv')->findBy(['Location' => $Location]);
       
        return $this->render(
                        'default/display.html.twig', array(
                    'advs' => $adv_repository,)
        );
    }

   
}
