<?php

namespace App\Controller;

// activation sms ligne 122

use App\Controller\IndexController;
use App\Controller\ObjectManager;
use App\Entity\Adhesion;
use App\Entity\User;
use App\Form\ResetPasswordType;
use App\Form\UserType;
use App\Repository\AdhesionRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

  
class IndexController extends AbstractController
{
    /**
     *@var UserRepository
     *
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    

    /**
     * 
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/home.html.twig');
    }

    /**
     * 
     * @Route("/show/{id}", name="show")
     */
    public function show(User $user)
    {
       
        return $this->render('security1/show.html.twig',[
            'user'=> $user,
        ]);
    }

     /**
     * 
     * @Route("/forgetpass", name="forgetpass")
     */
    public function forgetpass(Request $request)
   //  public function forgetpass(Request $request, ObjectManager $manager)
    { 
        
         $user = new User();
         $form = $this->createFormBuilder($user)
                ->add('username')  
                ->add('save',SubmitType::class, ['label' => 'Envoyer'])
                ->getForm();
         $form->handleRequest($request);
         if ($form->isSubmitted()) {
                    if ($user) {
                            return $this->redirectToRoute('forgetpassafter', [
                            'user' => $user,
                            'myusername' => $user->getUsername(), 
                            ]);

                            } 
         } 
         return $this->render('security2/forgetpass.html.twig', [
            'formUser' =>$form->createView(),
        ]); 
    } 

    /**
     * 
     * @Route("/forgetpassafter/{myusername}", name="forgetpassafter")
     */
    public function forgetpassafter(Request $request, $myusername):Response
    {
        $repository = $this->getDoctrine()
                   ->getManager()
                   ->getRepository(User::class);
        $user = $this->repository->findOneBy(array('username' => $myusername));

        if (! $user) {
            return $this->redirectToRoute('forgetpass');
        }
        $insertisok = false;
        $numrand =  rand (1000, 9999);
        $pass = $numrand ;
        $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
        if (password_verify($pass, $pass_hash)) {
            $testrand = "fpiinscription.com Votre Mot de passe provisoire est: $pass";
            $user->setPassword($pass_hash);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
//        debut sms
            $username = $user->getUsername();
            $request->getSession()->getFlashBag()->add('notice', 'Inscription bien enregistrée.');
            $message_inscription = $testrand;
            //vérouillage ou dévérouillage des envois sms grace à $insertisok
            // $insertisok = false;
            $insertisok = true;
            if ($insertisok) {
                return $this->redirectToRoute('envoiesms_departsms',[
                    'number_phone' => $username,
                    'message_phone' => $testrand
                ]);
            }
            else{
                return $this->render('page_erreurr_sms.html.twig');
            }
        }
        
    } 
    
 /**
     * @Route("/editecheance/{adhesionId}",name="echeance", methods={"GET","POST"})
     * @param Request            $request
     * @param UserRepository $repository
     * 
     * @return Response
     */   
public function editecheance(Request $request, $adhesionId):Response
{
  $nbremois = 112;
  $user=$this->getUser();
  $em = $this->getDoctrine()->getManager();

  // On récupère l'annonce
  $user = $em->getRepository(User::class)->find($adhesionId);

  $echeance = $user->getAdhesion()->getDateecheancebis();
  $dateDepart = $echeance;
  $duree = $nbremois;
  $dateDepart->modify('+'.$duree.'months');
  $date = $dateDepart->format('Y-m-d H:i:s.u');
  // On modifie l'URL de l'image par exemple
  
  $user->getAdhesion()->setDateecheancebis($dateDepart);
  $user->getAdhesion()->setLastName('erick');

  // On n'a pas besoin de persister l'annonce ni l'image.
  // Rappelez-vous, ces entités sont automatiquement persistées car
  // on les a récupérées depuis Doctrine lui-même
  
  // On déclenche la modification
  $em->flush();

  return new Response('OK');
}

     /**
     * 
     * @Route("/signature", name="signature")
     */
    public function signature(Request $request)
   //  public function forgetpass(Request $request, ObjectManager $manager)
    {
        $user = new User();
        $user = $this->getUser();
        $datesignat=$user->getDatesignat();
        if (empty($datesignat)) {
            $form = $this->createFormBuilder($user)
                ->add('save', SubmitType::class, ['label' => 'Signature'])
                ->getForm();
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                if ($user) {
                    return $this->redirectToRoute('signatureafter', [
                            'user' => $user,
                            'myusername' => $user->getUsername(),
                            ]);
                }
            }
            return $this->render('security2/signature.html.twig', [
            'formUser' =>$form->createView(),
        ]);
        }
        else {return $this->render('security2/signatureko.html.twig');}
    }
    /**
     * 
     * @Route("/signatureafter/{myusername}", name="signatureafter")
     */
    public function signatureafter(Request $request, $myusername):Response
    {
        $repository = $this->getDoctrine()
                   ->getManager()
                   ->getRepository(User::class);
        $user = $this->repository->findOneBy(array('username' => $myusername));

        if (! $user) {
            return $this->redirectToRoute('forgetpass');
        }
        $insertisok = false;
        $numrand =  rand (1000, 9999);
        $pass = $numrand ;
        // $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
        // if (password_verify($pass, $pass_hash)) {
            $testrand = "fpiinscription.com  Votre Code de signature est: $pass";
            $user->setSignature($pass);
            // $user->setDateSignat(new \DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
        //   debut sms
            $username = $user->getUsername();
            $request->getSession()->getFlashBag()->add('notice', 'Inscription bien enregistrée.');
            $message_inscription = $testrand;
            //vérouillage ou dévérouillage des envois sms grace à $insertisok
            // $insertisok = false;
            $insertisok = true;
            if ($insertisok) {
                return $this->redirectToRoute('envoiesms_signaturesms',[
                    'number_phone' => $username,
                    'message_phone' => $testrand,
                    'pass' => $numrand 
                ]);
            }
            else{
                return $this->render('page_erreurr_sms.html.twig');
            }
        
        
    } 


    /**
     * 
     * @Route("/signaturetripleafter", name="signaturetripleafter")
     */
    public function signaturetripleafter(Request $request)
    { 
        
         $user = new User();
         $usertest = $this->getUser();
         $signatureold = $usertest->getSignature();
        //  var_dump($signatureold);
         $form = $this->createFormBuilder($user)
                ->add('username',HiddenType::class) 
                ->add('signature') 
                ->add('save',SubmitType::class, ['label' => 'Envoyer'])
                ->getForm();
         $form->handleRequest($request);
         if ($form->isSubmitted()) {
            $signaturenew=$user->getSignature();
        // var_dump($signaturenew);
            if($signatureold==$signaturenew){
                $user=$this->getUser();
                $user->setDateSignat(new \DateTime('now'));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
                return $this->render('security2/finsignaturesms.html.twig');
                 }
            //  }
         }
    return $this->render('security2/signaturetripleafter.html.twig', [
        'formUser' =>$form->createView(),
    ]); 
    }

 
       /**
     * 
     * @Route("/rolemodifun", name="rolemodifun")
     */
    public function rolemodifun(Request $request, UserRepository $userRepository)
    { 
        
         $user = new User();
         $listeUsers=$userRepository->findAll();

         $form = $this->createFormBuilder($user)
                ->add('username')
                ->add('roles', ChoiceType::class, [
                    'choices' => [
                        'Sympathisant' => 'ROLE_SYMPATHISANT',
                        'Technique' => 'ROLE_TECHNIQUE',
                        'Admin' => 'ROLE_ADMIN',
                        'Superadmin' => 'ROLE_SUPER_ADMIN',
                    ],
                    'expanded'  => false, // liste déroulante
                    'multiple'  => true, // choix multiple
                ])
                ->add('save',SubmitType::class, ['label' => 'Envoyer'])
                ->getForm();
         $form->handleRequest($request);
         if ($form->isSubmitted()) {
                                $username=$user->getUsername();
                                $roles=$user->getRoles();
                                $user = $userRepository->findOneBy(array('username' => $username));
                                if(empty($user)){
                                    return $this->render('security2/rolemodifunv1.html.twig', [
                                        'formUser' => $form->createView(),
                                        'message_securiry2' => "ATTENTION: Votre identifiant est invalide"
                                        ]);
                                }
                                // return $this->redirectToRoute('rolemodifdeux',[
                                // 'id' => $user->getId(),
                                // 'selectrole' => $selectrole,
                                //  ]);

                                
                                 $user->setRoles($roles);
                                 $entityManager = $this->getDoctrine()->getManager();
                                 $entityManager->flush();
                                 return $this->render('security2/rolemodiftroisv3.html.twig',[
                                    'formUser' => $form->createView(),
                                     'user' => $user,
                                 ]);
                            }
return $this->render('security2/rolemodifunv1.html.twig', [
'formUser' => $form->createView(),
]); 
}

   /**
     * 
     * @Route("/{id}/{selectrole}/rolemodifdeux", name="rolemodifdeux")
     */
    public function rolemodifdeux(Request $request, User $user, $selectrole)
    {
        $user->setRoles(array('ROLE_PERSONNE'));
                            $entityManager = $this->getDoctrine()->getManager();
                            $entityManager->flush();
                            return $this->render('security2/rolemodiftroisv3.html.twig',[
                                'user' => $user,
                            ]); 
        
    }

/**
* 
* @Route("/{id}/rolemodiftrois", name="rolemodiftrois")
*/
public function rolemodiftrois(Request $request, User $user)
{ 
    $form = $this->createFormBuilder($user)
    ->add('username') 
    ->add('save',SubmitType::class, ['label' => 'Envoyer'])
    ->getForm();
    $form->handleRequest($request);
                        if ($form->isSubmitted()) {
                            $user->setRoles(array('ROLE_TECHNIQUE'));
                            $entityManager = $this->getDoctrine()->getManager();
                            $entityManager->flush();
                            return $this->render('security2/rolemodiftroisv3.html.twig',[
                                'user' => $user,
                            ]); 
                            }
                        
    return $this->render('security2/rolemodifdeuxv1.html.twig', [
            'formUser' =>$form->createView(),
            ]); 
            }
                
    }
        