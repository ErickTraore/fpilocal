<?php

namespace App\Controller;

use App\Entity\Smsbureau;
use App\Form\SmsbureauType;
use App\Repository\SmsbureauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/smsbureau")
 */
class SmsbureauController extends AbstractController
{
    /**
     * @Route("/", name="smsbureau_index", methods={"GET"})
     */
    public function index(SmsbureauRepository $smsbureauRepository): Response
    {
        return $this->render('smsbureau/index.html.twig', [
            'smsbureaus' => $smsbureauRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="smsbureau_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $smsbureau = new Smsbureau();
        $form = $this->createForm(SmsbureauType::class, $smsbureau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $message_phone = $smsbureau->getMessagesms();
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($smsbureau);
            $entityManager->flush();

            return $this->redirectToRoute('smsbureau_index');
        }

        return $this->render('smsbureau/new.html.twig', [
            'smsbureau' => $smsbureau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="smsbureau_show", methods={"GET"})
     */
    public function show(Smsbureau $smsbureau): Response
    {
        return $this->render('smsbureau/show.html.twig', [
            'smsbureau' => $smsbureau,
        ]);
    }

    /**
     * @Route("/smshistorique/{id}", name="smsbureau_smshistorique", methods={"GET"})
     */
    public function smshistorique(Smsbureau $smsbureau): Response
    {
        $textesms = $smsbureau->getMessagesms();
        return $this->redirectToRoute('tablelyon_smshistorique', [
            'textesms' => $textesms 
        ]);
    }

      /**
     * @Route("/smsehivet/{id}", name="smsbureau_smsehivet", methods={"GET"})
     */
    public function smsehivet(Smsbureau $smsbureau): Response
    {
        $textesms = $smsbureau->getMessagesms();
        return $this->redirectToRoute('tablelyon_smsehivet', [
            'textesms' => $textesms 
        ]);
    }

      /**
     * @Route("/smsgrenoble/{id}", name="smsbureau_smsgrenoble", methods={"GET"})
     */
    public function smsgrenoble(Smsbureau $smsbureau): Response
    {
        $textesms = $smsbureau->getMessagesms();
        return $this->redirectToRoute('tablelyon_smsgrenoble', [
            'textesms' => $textesms 
        ]);
    }

    /**
     * @Route("/smsconsultation/{id}", name="smsbureau_smsconsultation", methods={"GET"})
     */
    public function smsconsultation(Smsbureau $smsbureau): Response
    {
        $textesms = $smsbureau->getMessagesms();
        return $this->redirectToRoute('tablelyon_smsconsultation', [
            'textesms' => $textesms 
        ]);
    }

    /**
     * @Route("/{id}/edit", name="smsbureau_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Smsbureau $smsbureau): Response
    {
        $form = $this->createForm(SmsbureauType::class, $smsbureau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('smsbureau_index');
        }

        return $this->render('smsbureau/edit.html.twig', [
            'smsbureau' => $smsbureau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="smsbureau_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Smsbureau $smsbureau): Response
    {
        if ($this->isCsrfTokenValid('delete'.$smsbureau->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($smsbureau);
            $entityManager->flush();
        }

        return $this->redirectToRoute('smsbureau_index');
    }
}
