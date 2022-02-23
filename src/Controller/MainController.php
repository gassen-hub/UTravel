<?php

namespace App\Controller;


use App\Entity\Endroit;
use App\Form\CrudType ; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(Endroit::class)->findAll();
        return $this->render('main/index.html.twig', [
            'list' => $data
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
        public function create (Request $request)
        {
            $endroit = new Endroit() ; 
            $form = $this->createForm(CrudType::class, $endroit) ; 
        $form->handleRequest($request) ; 
        if($form ->isSubmitted()&& $form->isValid())
        {
            $em = $this->getDoctrine()->getManager() ; 
            $em->persist($endroit) ; 
            $em->flush() ; 
            $this->addFlash('notice','Submitted!') ; 

        }

        return $this->render('main/create.html.twig',['form'=>$form->CreateView()]);
        return $this->redirectToRoute('main') ; 
        }

    /**
     * @Route("/update/{id}", name="update")
     */
    public function update (Request $request,$id)
    {
        $endroit = $this->getDoctrine()->getRepository(Endroit::class)->find($id);
        $form = $this->createForm(CrudType::class, $endroit) ; 
        $form->handleRequest($request) ; 
        if($form ->isSubmitted()&& $form->isValid())
    {
        $em = $this->getDoctrine()->getManager() ; 
        $em->persist($endroit) ; 
        $em->flush() ; 
        $this->addFlash('notice','Updated!') ; 
        return $this->redirectToRoute('main') ; 

    }

    return $this->render('main/update.html.twig',['form'=>$form->CreateView()]);

    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete ($id)
    {
        $em = $this->getDoctrine()->getManager() ; 
    $data = $this->getDoctrine()->getRepository(Endroit::class)->find($id);
       
        
        $em->remove($data) ; 
        $em->flush() ; 
        return $this->redirectToRoute('main') ; 
    }



  




}







