<?php

namespace App\Controller;

use App\Entity\Tablesection2;
use App\Form\Tablesection2Type;
use App\Repository\Tablesection2Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tablesection2")
 */
class Tablesection2Controller extends AbstractController
{
    /**
     * @Route("/", name="tablesection2_index", methods={"GET"})
     */
    public function index(Tablesection2Repository $tablesection2Repository): Response
    {
        return $this->render('tablesection2/index.html.twig', [
            'tablesection2s' => $tablesection2Repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tablesection2_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tablesection2 = new Tablesection2();
        $form = $this->createForm(Tablesection2Type::class, $tablesection2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tablesection2);
            $entityManager->flush();

            return $this->redirectToRoute('tablesection2_index');
        }

        return $this->render('tablesection2/new.html.twig', [
            'tablesection2' => $tablesection2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tablesection2_show", methods={"GET"})
     */
    public function show(Tablesection2 $tablesection2): Response
    {
        return $this->render('tablesection2/show.html.twig', [
            'tablesection2' => $tablesection2,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tablesection2_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tablesection2 $tablesection2): Response
    {
        $form = $this->createForm(Tablesection2Type::class, $tablesection2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tablesection2_index');
        }

        return $this->render('tablesection2/edit.html.twig', [
            'tablesection2' => $tablesection2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tablesection2_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tablesection2 $tablesection2): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tablesection2->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tablesection2);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tablesection2_index');
    }
}
