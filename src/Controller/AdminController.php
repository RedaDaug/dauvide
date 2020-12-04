<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\MainProductRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin.")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     * @param MainProductRepository $mainProductRepository
     * @return Response
     */
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository, MainProductRepository $mainProductRepository)
    {
        $categories = $categoryRepository->findAll();
        $products = $productRepository->findAll();
        $mainProducts = $mainProductRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'products' => $products,
            'categories' => $categories,
            'mainProducts' => $mainProducts

        ]);
    }
}
