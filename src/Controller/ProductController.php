<?php

namespace App\Controller;


use App\Controller\ProductController;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/new", name="product_new")
     */
    public function new(Request $request, EntityManagerInterface $em)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
       
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $product->getBrochureFilename();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $file->move(
                    $this->getParameter('brochures_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $product->setBrochureFilename($fileName);

            // ... persist the $product variable or any other work
            $brochureFilename = $product->getBrochureFilename();
            $titre = $product->getTitre();
            $product->setTitre($titre);
            $product->setBrochureFilename($brochureFilename);
             $em->persist($product);
             $em->flush();
             return $this->render('home/home.html.twig');
        }
            return $this->render('product/new.html.twig', [
            'controller_name' => 'ProductController',
            'form'=> $form->createView()
        ]);
    }

     /**
     * @Route("/index", name="product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
}
