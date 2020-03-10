<?php

namespace App\Controller;

use App\Entity\Tablesection3;
use App\Form\Tablesection3Type;
use App\Repository\Tablesection3Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tablesection3")
 */
class Tablesection3Controller extends AbstractController
{
    /**
     * @Route("/", name="tablesection3_index", methods={"GET"})
     */
    public function index(Tablesection3Repository $tablesection3Repository): Response
    {
        return $this->render('tablesection3/index.html.twig', [
            'tablesection3s' => $tablesection3Repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tablesection3_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tablesection3 = new Tablesection3();
        $form = $this->createForm(Tablesection3Type::class, $tablesection3);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tablesection3);
            $entityManager->flush();

            return $this->redirectToRoute('tablesection3_index');
        }

        return $this->render('tablesection3/new.html.twig', [
            'tablesection3' => $tablesection3,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tablesection3_show", methods={"GET"})
     */
    public function show(Tablesection3 $tablesection3): Response
    {
        return $this->render('tablesection3/show.html.twig', [
            'tablesection3' => $tablesection3,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tablesection3_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tablesection3 $tablesection3): Response
    {
        $form = $this->createForm(Tablesection3Type::class, $tablesection3);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tablesection3_index');
        }

        return $this->render('tablesection3/edit.html.twig', [
            'tablesection3' => $tablesection3,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tablesection3_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tablesection3 $tablesection3): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tablesection3->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tablesection3);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tablesection3_index');
    }
}
