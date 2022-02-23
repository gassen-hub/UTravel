<?php

namespace App\Controller;
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
        $data = $this->getDoctrine()->getRepository(Endroit::class)->findAll();
        return $this->render('front/index.html.twig', [
            'list' => $data
        ]);
    }
}
