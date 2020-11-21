<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
    public function index(ProductRepository $productRepository)
    {
        $products = $productRepository->findAll();
        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */

    public function create(Request $request){
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $form->get('image_name')->getData();
            if ($file) {
                /** @var UploadedFile $filename */
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();

                $file->move(
                    $this->getParameter('uploads_dir'),
                    $filename
                );

                $product->setImageName($filename);

            }
            $em->persist($product);
            $em->flush();
            $this->addFlash('success', "The product was added");

            return $this->redirect($this->generateUrl('admin.index'));
        }

        return $this->render('product/create.html.twig', [
            'form' => $form->createView()
        ]);

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

    /**
     * @Route("/delete/{id}", name="delete")
     * @param $id
     * @param ProductRepository $productRepository
     * @return Response
     */

    public function delete($id, ProductRepository $productRepository){
        $product = $productRepository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        $this->addFlash('success', "The product was deleted");
        return $this->redirect($this->generateUrl('admin.index'));

    }

    /**
     * @Route("/edit/{id}", name="edit")
     * @param Request $request
     * @param $id
     * @param ProductRepository $productRepository
     * @return Response
     */

    public function edit(Request $request, $id, ProductRepository $productRepository){

        $product = $productRepository->find($id);

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $form->get('image_name')->getData();
            if ($file) {
                /** @var UploadedFile $filename */
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();

                $file->move(
                    $this->getParameter('uploads_dir'),
                    $filename
                );

                $product->setImageName($filename);

            }
            $em->flush();
            $this->addFlash('success', "The product was updated");

            return $this->redirect($this->generateUrl('admin.index'));
        }


        return $this->render('product/edit.html.twig', [
            'form' => $form->createView(),
            'product' => $product
        ]);

    }

}
