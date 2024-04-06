<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/kontaktai", name="kontaktai")
     */

    public function kontaktai(): Response
    {
        return $this->render('home/kontaktai.html.twig');
    }

    /**
     * @Route("/apiemus", name="apiemus")
     */

    public function apiemus()
    {
        return $this->render('home/apiemus.html.twig');
    }

    /**
     * @Route("/aroma", name="aroma")
     */

    public function aroma()
    {
        return $this->render('home/aroma.html.twig');
    }

    /**
     * @Route("/saugos", name="saugos")
     */

    public function saugos()
    {
        return $this->render('home/saugos.html.twig');
    }


}
