<?php

namespace App\Controller;

use App\Repository\MainProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeasonController extends AbstractController
{
    /**
     * @Route("/season", name="season")
     */
    public function index(): Response
    {
        return $this->render('season/index.html.twig', [
            'controller_name' => 'SeasonController',
        ]);
    }

    /**
     * @param $id
     * @param MainProductRepository $mainProductRepository
     * @return Response
     */
    public function listWinterProducts(MainProductRepository $mainProductRepository)
    {

        $mainProducts = $mainProductRepository->findBy(['season' => "4"], ['name' => 'ASC']);

        return $this->render('home/_season_products.html.twig', [
            'mainProducts' => $mainProducts
        ]);
    }

    /**
     * @param $id
     * @param MainProductRepository $mainProductRepository
     * @return Response
     */
    public function listSpringProducts(MainProductRepository $mainProductRepository)
    {

        $mainProducts = $mainProductRepository->findBy(['season' => "1"]);

        return $this->render('home/_season_products.html.twig', [
            'mainProducts' => $mainProducts
        ]);
    }
}
