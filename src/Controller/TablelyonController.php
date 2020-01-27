<?php

namespace App\Controller;

use App\Entity\Tablelyon;
use App\Form\TablelyonType;
use App\Repository\TablelyonRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tablelyon")
 */
class TablelyonController extends AbstractController
{
    /**
     * @Route("/", name="tablelyon_index", methods={"GET"})
     */
    public function index(TablelyonRepository $tablelyonRepository): Response
    {
        return $this->render('tablelyon/index.html.twig', [
            'tablelyons' => $tablelyonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/bureau", name="tablelyon_bureau", methods={"GET"})
     */
    public function bureau(TablelyonRepository $tablelyonRepository): Response
    {
        return $this->render('tablelyon/index.html.twig', [
            'tablelyons' => $tablelyonRepository->findByTitre(),
        ]);
    }

    /**
     * @Route("/new", name="tablelyon_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tablelyon = new Tablelyon();
        $form = $this->createForm(TablelyonType::class, $tablelyon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tablelyon);
            $entityManager->flush();

            return $this->redirectToRoute('tablelyon_index');
        }

        return $this->render('tablelyon/new.html.twig', [
            'tablelyon' => $tablelyon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tablelyon_show", methods={"GET"})
     */
    public function show(Tablelyon $tablelyon): Response
    {
        return $this->render('tablelyon/show.html.twig', [
            'tablelyon' => $tablelyon,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tablelyon_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tablelyon $tablelyon): Response
    {
        $form = $this->createForm(TablelyonType::class, $tablelyon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tablelyon_index');
        }

        return $this->render('tablelyon/edit.html.twig', [
            'tablelyon' => $tablelyon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tablelyon_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tablelyon $tablelyon): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tablelyon->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tablelyon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tablelyon_index');
    }
}
