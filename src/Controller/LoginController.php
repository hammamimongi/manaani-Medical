<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Form\PostFormType;
use App\Form\RechercheFormType;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\Session;



class LoginController extends AbstractController
{
    /**
     * @Route("/connexion", name="login")
     */
    public function login(Request $request)
    {
        if ($request->getSession()->get('id')  != null)
        {
            return $this->redirectToRoute('profil');
        }
        return $this->render('login/signIn.html.twig');


    }

    /**
     * @Route("/loginVerif", name="loginVerif")
     */
    public function loginVerif(Request $request,UserInterface $user)
    {
        $userId=$user->getId() ;
        $session = new Session();
        $session->set('id',$userId);
        if ($userId  == null)
        {
            return $this->redirectToRoute('login');
        }
        if ($userId  != null)
        {
            return $this->redirectToRoute('profil');
        }
        return $this->render('login/signIn.html.twig');


    }
    /**
     * @Route("/profil", name="profil")
     */
    public function post(Request $request,PostRepository  $repository,UserRepository $userRepository)
    {




        if ($request->getSession()->get('id')  == null)
        {
            return $this->redirectToRoute('login');
        }


        $uid = $request->getSession()->get('id');
        $postR=$repository->UserPostRecherche($uid);
        $UserSession=$userRepository->find($uid);
        return $this->render('login/profil.html.twig',
            [
                'Post'=>$postR,
                'User'=>$UserSession,
            ]
        );
    }

    /**
     * @Route("/AjoutArticle", name="AjoutArticle")
     */
    public function addPost(Request $request,UserRepository $userRepository,UserInterface $userDetId){

        if ($request->getSession()->get('id')  == null){
            return $this->redirectToRoute('login');
        }
        $post=new Post();
        $UserDet= new User();
        $form=$this->createForm(PostFormType::class,$post);
        $form->add("Ajouter",SubmitType::class);
        $form->handleRequest($request);
        $user=$request->getSession()->get('id') ;
        $UserSession = $userRepository->find($user);
        if($form->isSubmitted() && $form -> isValid()){
            $em=$this->getDoctrine()->getManager();
            $file = $post->getImage();
            $quantite=$post->getQuantite();
            $fileName = md5(uniqid()) . "." . $file->guessExtension();

            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                $e->getMessage();
            }
            $setQuan="Bouteille oxygène ".$quantite."L";
            $post->setTitre($setQuan);
            $post->setImage($fileName);
            $post->setIdUser($userDetId);
            $em=$this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute("profil");
        }


        return $this->render('login/AjoutArticle.html.twig',
            [
                'User'=>$UserSession,
                'form'=>$form->createView()
            ]
        );
    }



    /**
     * @Route("/inscription", name="inscription")
     */
    function SignUp(Request  $request,UserRepository $repository,UserPasswordEncoderInterface $encoder)
    {
        if ($request->getSession()->get('id')  != null)
        {
            return $this->redirectToRoute('profil');
        }

        $user=new User();
        $form=$this->createForm(RechercheFormType::class,$user);
        $form->add("Ajouter",SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form -> isValid()){
            $hash = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $em=$this->getDoctrine()->getManager();
            $file = $user->getPdp();
            $fileName = md5(uniqid()) . "." . $file->guessExtension();

            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                $e->getMessage();
            }
            $user->setPdp($fileName);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("login");
        }
        return $this->render('login/SignUp.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route ("/deconnexion",name="logout")
     */
    public function logout(SessionInterface $session){
        $session->set('id',"");
    }
}
