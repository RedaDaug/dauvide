<?php

namespace App\Controller;

use App\Entity\MainProduct;
use App\Form\MainProductType;
use App\Form\ProductType;
use App\Repository\MainProductRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */

    public function create(Request $request){
        $mainProduct = new MainProduct();

        $form = $this->createForm(MainProductType::class, $mainProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $form->get('imageName')->getData();
            if ($file) {
                /** @var UploadedFile $filename */
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();

                $file->move(
                    $this->getParameter('uploads_dir'),
                    $filename
                );

                $mainProduct->setImageName($filename);

            }
            $em->persist($mainProduct);
            $em->flush();
            $this->addFlash('success', "The main product was added");

            return $this->redirect($this->generateUrl('admin.index'));
        }

        return $this->render('main_product/create.html.twig', [
            'form' => $form->createView()
        ]);

    }


    /**
     * @Route("/delete/{id}", name="delete")
     * @param $id
     * @param MainProductRepository $mainProductRepository
     * @return Response
     */

    public function delete($id, MainProductRepository $mainProductRepository){
        $mainProduct = $mainProductRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($mainProduct);
        $em->flush();

        $this->addFlash('success', "The main product was deleted");
        return $this->redirect($this->generateUrl('admin.index'));

    }

    /**
     * @Route("/edit/{id}", name="edit")
     * @param Request $request
     * @param $id
     * @param MainProductRepository $mainProductRepository
     * @return Response
     */

    public function edit(Request $request, $id, MainProductRepository $mainProductRepository){

        $mainProduct = $mainProductRepository->find($id);

        $form = $this->createForm(MainProductType::class, $mainProduct);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $form->get('imageName')->getData();
            if ($file) {
                /** @var UploadedFile $filename */
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();

                $file->move(
                    $this->getParameter('uploads_dir'),
                    $filename
                );

                $mainProduct->setImageName($filename);

            }
            $em->flush();
            $this->addFlash('success', "The main product was updated");

            return $this->redirect($this->generateUrl('admin.index'));
        }


        return $this->render('main_product/edit.html.twig', [
            'form' => $form->createView(),
            'mainProduct' => $mainProduct
        ]);

    }


    /**
     * @Route("/season/{id}", name="season")
     * @param $id
     * @param MainProductRepository $mainProductRepository
     * @return Response
     */

    public function findAllSeasonalProducts($id, MainProductRepository $mainProductRepository) {

        $mainProducts = $mainProductRepository->findBy(['season' => "$id"]);
        return $this->render('main_product/season.html.twig', [
            'mainProducts' => $mainProducts
        ]);
    }


}
