<?php

namespace App\Controller;

use App\Entity\Adhesion; 
use App\Entity\Count; 
use App\Entity\Image;
use App\Entity\User;
use App\Form\User1Type;
use App\Repository\AdhesionRepository;
use App\Repository\CountRepository;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package ;
use Symfony\Component\Asset\Packages ;
use Symfony\Component\Asset\PathPackage ;
use Symfony\Component\Asset\UrlPackage ;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/home", name="admin_home")
     */
    public function indexHome()
    {
        $content = file_get_contents('http://www.fpiinscription.com/users');
        $contents=json_decode($content,TRUE);//Decodes json into an array 
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'users' => $contents
            ]);
     
    }
    
    /**
    * @Route("/commandecarte", name="admin_commandecarte")
    */
    public function commandecarte(CountRepository $countRepository, AdhesionRepository $adhesionRepository, UserRepository $userRepository, ImageRepository $mageRepository):Response
    {
        $counts = $countRepository->findBy([
            'ref' => 'carte_2020'
        ]);
        $listusers[]='';

        foreach ($counts as $count) {
            $adhesion = $count->getAdhesion();
            $adhesionid = $adhesion->getId();
            $image = $adhesion->getImage();
            $listusers[]=$userRepository->findOneBy(['adhesion' => $adhesionid]);
        }
        return $this->render('admin/commandecarte.html.twig', [
                'listusers' => $listusers,
                'counts' => $counts
                ]);
    }
        
    /**
     * @Route("/listetotal", name="admin_listetotal")
     */
    public function listetotal(CountRepository $countRepository, AdhesionRepository $adhesionRepository, UserRepository $userRepository, ImageRepository $mageRepository):Response
    {
        $users = $userRepository->findAll();
        $adhesions = $adhesionRepository->findAll();
        $listusers[]='';
        
        foreach ($users as $user) {
            $adhesion = $user->getAdhesion();
            $listusers[]=$user;
        }
        return $this->render('admin/listetotal.html.twig', [
                'listusers' => $users,
                'adhesions' => $adhesions
                ]);
    }
        
    /**
     * @Route("/listeadherent", name="admin_listeadherent")
     */
    public function listeadherent(AdhesionRepository $adhesionRepository, UserRepository $userRepository, ImageRepository $mageRepository):Response
    {
        $user = new User();
        $users = $userRepository->findAll();
        $adhesions = $adhesionRepository->findAll();
        // $listusers[]='';
        // foreach ($users as $user) {
        //     $adhesion = $user->getAdhesion();
        //     $role = $user->getRoles();
        //     $listusers[]=$user;
        //}
        return $this->render('admin/listeadherent.html.twig', [
                'listusers' => $users,
                'adhesions' => $adhesions
                ]);
    }

    /**
     * @Route("/listeadmin", name="admin_listeadmin")
     */
    public function listeadmin(CountRepository $countRepository, AdhesionRepository $adhesionRepository, UserRepository $userRepository, ImageRepository $mageRepository):Response
    {
        $user = new User();
        $users = $userRepository->findAll();
        $adhesions = $adhesionRepository->findAll();
        $listusers[]='';
        
        foreach ($users as $user) {
            $adhesion = $user->getAdhesion();
            $role = $user->getRoles();
            $listusers[]=$user;
        }
        return $this->render('admin/listeadmin.html.twig', [
                'listusers' => $users,
                'adhesions' => $adhesions
                ]);
    }

       /**
     * @Route("/listesuperadmin", name="admin_listesuperadmin")
     */
    public function listesuperadmin(AdhesionRepository $adhesionRepository, UserRepository $userRepository, ImageRepository $mageRepository):Response
    {
        $user = new User();
        $users = $userRepository->findAll();
        $adhesions = $adhesionRepository->findAll();
        $listusers[]='';
        foreach ($users as $user) {
            $adhesion = $user->getAdhesion();
            $role = $user->getRoles();
            $listusers[]=$user;
        }
        return $this->render('admin/listesuperadmin.html.twig', [
                'listusers' => $listusers,
                'adhesions' => $adhesions
                ]);
    }
    
    /**
     * @Route("/paiementadherent", name="admin_paiementadherent")
     */
    public function paiementadherent(CountRepository $countRepository, AdhesionRepository $adhesionRepository, UserRepository $userRepository, ImageRepository $mageRepository):Response
    {
        $counts = $countRepository->findBy([
            'ref' => 'abonnement'
        ]);
        $listusers[]='';

        foreach ($counts as $count) {
            $adhesion = $count->getAdhesion();
            $adhesionid = $adhesion->getId();
            $image = $adhesion->getImage();
            $listusers[]=$userRepository->findOneBy(['adhesion' => $adhesionid]);
        }
        return $this->render('admin/paiementadherent.html.twig', [
                'listusers' => $listusers,
                'counts' => $counts
                ]);
    }

    /**
     * @Route("/paiementdon", name="admin_paiementdon")
     */
    public function paiementdon(CountRepository $countRepository, AdhesionRepository $adhesionRepository, UserRepository $userRepository, ImageRepository $mageRepository):Response
    {
        $counts = $countRepository->findBy([
            'ref' => 'don'
        ]);
        $listusers[]='';

        foreach ($counts as $count) {
            $adhesion = $count->getAdhesion();
            $adhesionid = $adhesion->getId();
            $image = $adhesion->getImage();
            $listusers[]=$userRepository->findOneBy(['adhesion' => $adhesionid]);
        }
        return $this->render('admin/paiementdon.html.twig', [
                'listusers' => $listusers,
                'counts' => $counts
                ]);
    }

    /**
     * @Route("/paiementvente", name="admin_paiementvente")
     */
    public function paiementvente(CountRepository $countRepository, AdhesionRepository $adhesionRepository, UserRepository $userRepository, ImageRepository $mageRepository):Response
    {
        $counts = $countRepository->findBy([
            'ref' => 'vente'
        ]);
        $listusers[]='';

        foreach ($counts as $count) {
            $adhesion = $count->getAdhesion();
            $adhesionid = $adhesion->getId();
            $image = $adhesion->getImage();
            $listusers[]=$userRepository->findOneBy(['adhesion' => $adhesionid]);
        }
        return $this->render('admin/paiementvente.html.twig', [
                'listusers' => $listusers,
                'counts' => $counts
                ]);
    }

    /**
     * @Route("/{id}/show", name="admin_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('admin/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
    * @Route("/index", name="admin_index", methods={"GET"})
    */
    public function index(UserRepository $userRepository, AdhesionRepository $adhesionRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'users' => $userRepository->findAll(),
            'adhesions' => $adhesionRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="admin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin_/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

  

    /**
     * @Route("/{id}/edit", name="admin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    


    /**
     * @Route("/{id}", name="admin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin__index');
    }
  

}