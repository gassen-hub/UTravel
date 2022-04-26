<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class covidController extends AbstractController
{
    /**
     * @Route("/covid", name="covid")
      * Convenience method for authenticating the user and returning the
     * Response *if any* for success.
     */
    
    public function index (CallApiService $callApiService): Response
    {
         
        return  $this->render('front/covid.html.twig', [
            'data' => $callApiService -> getData(), 
        ]); 
    }
}
