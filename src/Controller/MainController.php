<?php

namespace App\Controller;


use App\Entity\Endroit;
use App\Form\EndroitType;
use App\Form\CrudType ;
use App\Repository\EndroitRepository;
use Doctrine\DBAL\Driver\Mysqli\Initializer\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options as DompdfOptions;
use App\Form\SubmitType;

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
            $form = $this->createForm(EndroitType::class, $endroit) ; 
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

/**
     * @Route("/pdf/{id}", name="pdf" ,  methods={"GET"})
     */
    public function pdf($id,EndroitRepository $repository)
    {

        $endroit = $repository->find($id);

        $pdfOptions = new DompdfOptions();
        
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);
        $html = $this->renderView('main/pdf.html.twig', [
            'pdf' => $endroit
        ]);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        //  $dompdf->stream();
        // Output the generated PDF to Browser (force download)
        $dompdf->stream($endroit->getId(), [
            "Attachment" => true
        ]);
    }

  




}







