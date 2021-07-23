<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Form\FilterRechercheType;
use App\Form\PostFormType;
use App\Form\RechercheFormType;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


class PostController extends AbstractController
{
    /**
     * @Route("/oxygene ", name="oxygene")
     */
    public function addPost(PostRepository $repository,Request $request,UserRepository $userRep)
    {

        $post = new Post();

        if ($request->getSession()->get('id')  == null)
        {
            $PostSelect = $repository->AllPost();


            return $this->render('post/post.html.twig',
                [
                    'PostS'=>$PostSelect]
            );
        }
        else {
            $user=$request->getSession()->get('id') ;
            $UserSession = $userRep->find($user);
            $PostSelect = $repository->AllPost();

            $form=$this->createForm(FilterRechercheType::class,$post);
            $form->add("Ajouter",SubmitType::class);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form -> isValid()){
                $em=$this->getDoctrine()->getManager();
                $this->redirectToRoute("profil");
            }


            return $this->render('post/post.html.twig',
                [
                    'form'=>$form->createView(),
                    'PostS' => $PostSelect,
                    'User' => $UserSession,

                ]
            );
        }
    }
    /**
     * @Route("/oxygeneFiltre/{filtreBy} ", name="filtre")
     */
    public function FiltrePost(PostRepository $repository,Request $request,UserRepository $userRep)
    {

        if (!empty($_GET['Gouvernerat'])) {
            $Gouvernerat = $_GET['Gouvernerat'];
        } else {
            $Gouvernerat = "";
        }
        if (!empty($_GET['Categorie'])) {
            $Categorie = $_GET['Categorie'];
        } else {
            $Categorie = "";
        }
        if (!empty($_GET['Type'])) {
            $Type = $_GET['Type'];
        } else {
            $Type = "";
        }
        if (empty($_GET['Gouvernerat']) && empty($_GET['Categorie']) && empty($_GET['Type'])) {
            $this->redirectToRoute("oxygene");
        }


        $post = new Post();
        $sql = "SELECT u.*,p.*
        FROM post p
        INNER JOIN user u ON u.id = p.id_user_id";

        if (!empty($_GET['Gouvernerat'])) {
            $sql = $sql . " where adresse='$Gouvernerat'";
        }

        if ($request->getSession()->get('id') == null) {
            $PostSelect = $repository->filterPost($sql);


            return $this->render('post/recherche.html.twig',
                [
                    'PostS' => $PostSelect]
            );
        }
        if ($request->getSession()->get('id') != null) {
            $user = $request->getSession()->get('id');


            $UserSession = $userRep->find($user);

            $PostSelect = $repository->filterPost($sql);

            return $this->render('post/recherche.html.twig',
                [
                    'PostS' => $PostSelect,
                    'User' => $UserSession,

                ]
            );
        }
    }


}
