<?php

namespace App\Controller;

use App\Repository\MainProductRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mainproduct", name="mainproduct.")
 */
class MainProductController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param MainProductRepository $mainProductRepository
     * @return Response
     */
    public function index(MainProductRepository $mainProductRepository)
    {
        $mainProducts = $mainProductRepository->findAll();
        return $this->render('main_product/index.html.twig', [
            'mainProducts' => $mainProducts
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     * @param $id
     * @param productRepository $productRepository
     * @return Response
     */

    public function show($id, productRepository $productRepository) {
        $products = $productRepository->findBy(['mainProduct' => "$id"]);

        return $this->render('main_product/show.html.twig', [
            'products' => $products
        ]);
    }


    /**
     * @param $id
     * @param MainProductRepository $mainProductRepository
     * @return Response
     */
    public function listMainProducts($id, MainProductRepository $mainProductRepository)
    {

        $mainProducts = $mainProductRepository->findBy(['category' => "$id"]);

        return $this->render('main_product/_other_products_in_category.html.twig', [
            'mainProducts' => $mainProducts
        ]);
    }
}
