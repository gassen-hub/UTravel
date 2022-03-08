<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Post;
use App\Form\PostType;
use App\Form\CommentsType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class PostController extends AbstractController
{
    /**
     * @Route("/afficherposts",name="afficherposts")
     */
    public function Affiche(PostRepository $repository, Request $request)
    {
        $tablearticle = $repository->findAll();  
        $comment = new Comments();
        $Form =  $this->createForm(CommentsType::class, $comment);
        $Form->handleRequest($request);
        if ($Form->isSubmitted() && $Form->isValid()) {
            
            $comment->setCreatedAt(new \DateTime());
             
           // $comment->setPost($tablearticle);
            

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }

        return $this->render(
            'post/Article.html.twig',
            [
                'tablearticles' => $tablearticle,
                'commentForm' => $Form->createView()
            ]
        );
    }

    /**
     * @Route("/supprimerpost/{id}",name="supprimerpost")
     */
    public function delete($id, EntityManagerInterface $em, PostRepository $repository)
    {
        $post = $repository->find($id);
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('afficherposts');
    }

    /**
     * @Route("/addPost",name="addPost")
     */
    public function ajouterpost(EntityManagerInterface $em, Request $request, PostRepository $UserRepository)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->add('Ajouter', SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $new = $form->getData();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute("afficherposts");
        }
        return $this->render("post/addPost.html.twig", array("form" => $form->createView()));
    }



    /**
     * @Route("/{id}/UpdatePost", name="UpdatePost", methods={"GET","POST"})
     */
    public function modifierpost(Request $request, Post $post): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->add('Confirmer', SubmitType::class);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('afficherposts');
        }

        return $this->render('post/UpdatePost.html.twig', [
            'articlemodif' => $post,
            'form' => $form->createView(),
        ]);
    }
}
