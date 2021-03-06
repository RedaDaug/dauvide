<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\GroupRepository;
use App\Repository\MainProductRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/kategorija", name="category.")
 */

class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function index(CategoryRepository $categoryRepository)

    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */

    public function create(Request $request){
        $category = new Category();

        $category->setName("VISBELLA")
            ->setImageName('visbella.png');
        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();
        return new Response("lalala");

    }

    /**
     * @Route("/show/{id}", name="show")
     * @param $id
     * @param MainProductRepository $mainProductRepository
     * @return Response
     */

    public function findAllProductsInCategory($id, MainProductRepository $mainProductRepository) {

        $mainProducts = $mainProductRepository->findBy(['category' => "$id"], ['name' => 'ASC']);
        return $this->render('category/show.html.twig', [
            'mainProducts' => $mainProducts
        ]);
}

    /**
     * @Route("/show/aroma", name="showAroma")
     * @param $id
     * @param MainProductRepository $mainProductRepository
     * @return Response
     */

    public function findAllAromaProducts(MainProductRepository $mainProductRepository) {

        $mainProducts = $mainProductRepository->findBy(['category' => "2"], ['name' => 'ASC']);
        return $this->render('category/showaroma.html.twig', [
            'mainProducts' => $mainProducts
        ]);
    }


}
