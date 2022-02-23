<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilBackController extends AbstractController
{
    /**
     * @Route("/acceuil/back", name="acceuil_back")
     */
    public function index(): Response
    {
        return $this->render('back.html.twig', [
            'controller_name' => 'AcceuilBackController',
        ]);
    }
}
