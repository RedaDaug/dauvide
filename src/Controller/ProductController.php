<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product", name="product.")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */

    public function create(Request $request){
        $product = new Product();

        $product->setName("AROMA gaiviklis")

            ->setImageName('visbella.png');
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();
        return new Response("Gaiviklis pridetas");

    }

    /**
     * @Route("/show/{id}", name="show")
     * @param $id
     * @return Response
     */

    public function show($id) {

        return $this->render('category/show.html.twig', [
            'sup_products' => $sup_products
        ]);
    }

}
