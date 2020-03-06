<?php

namespace App\Controller;

use App\Entity\Tableconsultation;
use App\Form\TableconsultationType;
use App\Repository\TableconsultationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tableconsultation")
 */
class TableconsultationController extends AbstractController
{
    /**
     * @Route("/", name="tableconsultation_index", methods={"GET"})
     */
    public function index(TableconsultationRepository $tableconsultationRepository): Response
    {
        return $this->render('tableconsultation/index.html.twig', [
            'tableconsultations' => $tableconsultationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tableconsultation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tableconsultation = new Tableconsultation();
        $form = $this->createForm(TableconsultationType::class, $tableconsultation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tableconsultation);
            $entityManager->flush();

            return $this->redirectToRoute('tableconsultation_index');
        }

        return $this->render('tableconsultation/new.html.twig', [
            'tableconsultation' => $tableconsultation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tableconsultation_show", methods={"GET"})
     */
    public function show(Tableconsultation $tableconsultation): Response
    {
        return $this->render('tableconsultation/show.html.twig', [
            'tableconsultation' => $tableconsultation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tableconsultation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tableconsultation $tableconsultation): Response
    {
        $form = $this->createForm(TableconsultationType::class, $tableconsultation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tableconsultation_index');
        }

        return $this->render('tableconsultation/edit.html.twig', [
            'tableconsultation' => $tableconsultation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tableconsultation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tableconsultation $tableconsultation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tableconsultation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tableconsultation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tableconsultation_index');
    }
}
