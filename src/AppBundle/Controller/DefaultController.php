<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Adv;

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
     */
    public function showDetailsAction($id, Request $request) {
        $comment = new \AppBundle\Entity\Comment();
        $adv = new \AppBundle\Entity\Adv();
        $em = $this->getDoctrine()->getManager();
        $adv_repository = $em->getRepository('AppBundle:Adv')->find($id);
        $comment_repository = $em->getRepository('AppBundle:Comment')->findBy(array('advId' => $id));
        $form = $this->createForm(\AppBundle\Form\CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setAdvId($id);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }

        return $this->render(
                        'default/displayDetails.html.twig', array(
                    'advs' => $adv_repository, 'form' => $form->createView(),'comments' => $comment_repository)
        );
    }

    /**
     * @Route("/display/Categories/{cat}", name="app_display_Categories")
     */
    public function showCatAction($cat, Request $request) {


        $adv = new \AppBundle\Entity\Adv();

        $em = $this->getDoctrine()->getManager();
        $adv_repository = $em->getRepository('AppBundle:Adv')->findBy(array('cat' => $cat));


        return $this->render(
                        'default/display.html.twig', array(
                    'advs' => $adv_repository,)
        );
    }

    /**
     * @Route("/display/City/{city}", name="app_display_City")
     */
    public function showCityAction($city, Request $request) {


        $adv = new \AppBundle\Entity\Adv();
        $em = $this->getDoctrine()->getManager();
        $adv_repository = $em->getRepository('AppBundle:Adv')->findBy(array('city' => $city));


        return $this->render(
                        'default/display.html.twig', array(
                    'advs' => $adv_repository,)
        );
    }

}
