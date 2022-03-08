<?php

namespace App\Controller;
use App\Entity\Activite;
use App\Form\ActiviteType ; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ActiviteController extends AbstractController
{
     /**
     * @Route("/activite", name="activite")
     */
    public function index(): Response
    {
        $act = $this->getDoctrine()->getRepository(Activite::class)->findAll();
        return $this->render('activite/index.html.twig', [
            'activite' => $act
        ]);
    }

    /**
     * @Route("/activite/c", name="act")
     */
        public function create (Request $request)
        {
            $activte = new Activite() ; 
            $form = $this->createForm(ActiviteType::class, $activte) ; 
        $form->handleRequest($request) ; 
        if($form ->isSubmitted()&& $form->isValid())
        {
            $em = $this->getDoctrine()->getManager() ; 
            $em->persist($activte) ; 
            $em->flush() ; 
            $this->addFlash('notice','Submitted!') ; 

        }

        return $this->render('activite/create.html.twig',['form'=>$form->CreateView()]);
        return $this->redirectToRoute('activite') ; 
        }

    /**
     * @Route("/activite/update/{id}", name="updateact")
     */
    public function update (Request $request,$id)
    {
        $act = $this->getDoctrine()->getRepository(Activite::class)->find($id);
        $form = $this->createForm(ActiviteType::class, $act) ; 
        $form->handleRequest($request) ; 
        if($form ->isSubmitted()&& $form->isValid())
    {
        $em = $this->getDoctrine()->getManager() ; 
        $em->persist($act) ; 
        $em->flush() ; 
        $this->addFlash('notice','Updated!') ; 
        return $this->redirectToRoute('activite') ; 

    }

    return $this->render('activite/update.html.twig',['form'=>$form->CreateView()]);

    }

    /**
     * @Route("/activite/delete/{id}", name="deleteact")
     */
    public function delete ($id)
    {
        $em = $this->getDoctrine()->getManager() ; 
    $act = $this->getDoctrine()->getRepository(Activite::class)->find($id);
       
        
        $em->remove($act) ; 
        $em->flush() ; 
        return $this->redirectToRoute('activite') ; 
    }



  
}
