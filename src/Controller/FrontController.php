<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Endroit;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/front", name="front")
     */
    public function index(): Response
    {
        $cat = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $data = $this->getDoctrine()->getRepository(Endroit::class)->findAll();
        return $this->render('front/index.html.twig', [
            'list' => $data ,
            'lis' => $cat 
           
        ]);
    }
     /**
     * @Route("/front/detail/{id}", name="detail")
     */
    public function detail($id) 
    {
        $cat = $this->getDoctrine()->getRepository(Categorie::class)->findAll($id);
        $data = $this->getDoctrine()->getRepository(Endroit::class)->findAll($id);
        return $this->render('front/detail.html.twig', [
            'list' => $data ,
            'lis' => $cat 
        ]);
    }





    
}
