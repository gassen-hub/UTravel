<?php

namespace App\Controller;


use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;
use App\Entity\Comments;
use App\Entity\Upvote;
use App\Form\CommentsType;
use App\Repository\PostRepository;
use App\Repository\CommentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
class PostController extends AbstractController
{
    /**
     * @Route("/{id}/Show", name="Show", methods={"GET","POST"})
     */
    public function show(Request $request,$id,PostRepository $postRepository,CommentsRepository $commentRepository)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Post::class)->find($id);
        $value = $post->getAbn();
        $value = $value + 1 ;
        $post->setAbn($value);
        $entityManager->flush();
        $comment = new Comments();
        $session = $request->getSession();
        $form1 = $this->createForm(CommentsType::class,$comment);
        $form1->handleRequest($request);
        if ($form1->isSubmitted() && $form1->isValid()) {
            $comment->setCreatedAt(new \DateTime())
                ->setPost($post);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute('Show',['id'=>$id]);
        }
        $posttype = $postRepository->findBy(['id' => $id]);
        $postpost = $commentRepository->findBy(['post'=>$post]);
        return $this->render('/post/show.html.twig', [
            'comments'=> $postpost,
            'tablearticles' => $posttype,
            'commentForm'=>$form1->createView(),
        ]);
    }
    /**
     * @Route("/afficherposts",name="afficherposts")
     */
    public function Affiche(PostRepository $repository, Request $request)
    {
        $tablearticle = $repository->findBY([],['abn' => 'ASC']);  
        $comment = new Comments();
        $Form =  $this->createForm(CommentsType::class, $comment);
        $Form->handleRequest($request);
        if ($Form->isSubmitted() && $Form->isValid()) {
            
            $comment->setCreatedAt(new \DateTime());
             
          //  $comment->setPost($tablearticle);
            

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
     * @param $id
     * @param PostRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/likepost/{id}", name="likepost")
     */
    public function likepost(PostRepository $repository , $id)
    {
        $post=$repository->find($id);
        $new=$post->getJaime() + 1;
        $post->setJaime($new);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('afficherposts');
    }

    /**
     * @param $id
     * @param PostRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/dislikepost/{id}", name="dislikepost")
     */
    public function dislikePost(PostRepository $repository , $id )
    {
        $post=$repository->find($id);
        $new=$post->getJaimepas() + 1;
        $post->setJaimepas($new);
        $this->getDoctrine()->getManager()->flush();
        //return $this->render('home/afficheE.html.twig', ['event' => $event]);

        return $this->redirectToRoute('afficherposts');
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
    public function modifierpost(Request $request,$id,PostRepository $postRepository,CommentsRepository $commentRepository)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Post::class)->find($id);
        $value = $post->getAbn();
        $value = $value + 1 ;
        $post->setAbn($value);
        $entityManager->flush();
        $comment = new Comments();
        $session = $request->getSession();
        $form1 = $this->createForm(CommentsType::class,$comment);
        $form1->handleRequest($request);
        if ($form1->isSubmitted() && $form1->isValid()) {
            $comment->setCreatedAt(new \DateTime())
                ->setPost($post);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute('UpdatePost',['id'=>$id]);
        }

        $posttype = $postRepository->findBy(['id' => $id]);
        $postpost = $commentRepository->findBy(['post'=>$post]);

        return $this->render('/post/show.html.twig', [
            'comments'=> $postpost,
            'tablearticles' => $posttype,
            'commentForm'=>$form1->createView(),
        ]);
    }
    /**
      * @Route("/upvote-post", name="upvotepost")
      */
      public function upvotePostAction(PostRepository $repository ,Request $request, User $user)
      {
  
        
          $upvote = new Upvote();
          $user  = new User();
          $post = $repository->getDoctrine()
          ->getRepository(Post::class)
          ->findPostById($request->request->get('id'));
  
          $upvote->setUser($user);
          $upvote->setPost($post);
          $upvote->incrUpvote($post);
  
          $em = $this->getDoctrine()->getManager();
          $em->persist($upvote);
          $em->flush();
  
          return new JsonResponse('success');
  
         
          
        }
   /**
 * @Route("/stat/{id}", name="stat")
 */
public function statAction($id): Response
{
    $pieChart = new PieChart();

    $entityManager = $this->getDoctrine()->getManager();
    $objet = $entityManager->getRepository(Post::class)->find($id);
    $pieChart = new PieChart();
    $pieChart->getData()->setArrayToDataTable( array(
        ['post', 'Nombre de jaime'],
        ['Jaime',     $objet->getJaime() ],
        ['Jaime pas',      $objet->getJaimepas() ],
    ));

    $pieChart->getOptions()->setTitle('Stat Jaime par post');
    $pieChart->getOptions()->setHeight(400);
    $pieChart->getOptions()->setWidth(400);
    $pieChart->getOptions()->getTitleTextStyle()->setColor('#07600');
    $pieChart->getOptions()->getTitleTextStyle()->setFontSize(25);


    return $this->render('post/statrec.html.twig', array(
            'piechart' => $pieChart,
        )

    );

}
      
    /**
     * @Route("/upPost/{id}", name="upPost")
     */
    public function upPost(Request $request, Post $post): Response
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
