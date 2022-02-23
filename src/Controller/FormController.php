<?php

namespace App\Controller;
use App\Entity\Endroit;
use App\Entity\CrudType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
      /**
     * @Route("/tt", name="tt")
     */
    public function index(): Response
    {
        return $this->render('main/create.html.twig', [
            'controller_name' => 'FormController',
        ]);

    
    }

   

    
  
}
