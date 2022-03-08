<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reservation;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(): Response
    {
        $em= $this->getDoctrine()->getManager();
        $reservations=$this->getDoctrine()->getManager()->getRepository(Reservation::class)->findAll();        
        return $this->render('reservation/index.html.twig', array(
            'controller_name' => 'ReservationController',
            'reservations' => $reservations,
        ));
    }

    /**
     * @Route("/user/reservation/new/{id}")
     */
    public function createAction(Request $request, $id,\Swift_Mailer $mailer) {
        $em= $this->getDoctrine()->getManager();
        $reservation = new Reservation();
        $reservation->setTrip($id);
        $reservation->setUser("1");
        $reservation->setDate(new \DateTime());
        $reservation->setStatus("Created");
        $em->persist($reservation);
        $em->flush();
        // Ici nous enverrons le mail
        $message = (new \Swift_Message('Confirmation de reservation'))
            // On attribue l'expéditeur
            ->setFrom("utravelpdev@gmail.com")
            // On attribue le destinataire
            ->setTo("anis.tounekti@esprit.tn")
            ->setBody("Votre numéro de reservation est ".$reservation->getId(),'text/html');
            // On envoie le message
        $mailer->send($message);
        $this->addFlash('message', 'la reservation a été enregistré');
        return $this->redirectToRoute('user_trip', []);
    }

    /**
     * @Route("/user/myreservation", name="my_reservation")
     */
    public function indexMyResevation(): Response
    {
        $em= $this->getDoctrine()->getManager();
        $reservations=$this->getDoctrine()->getManager()->getRepository(Reservation::class)->findAll();        
        return $this->render('reservation/myreservation.html.twig', array(
            'controller_name' => 'ReservationController',
            'reservations' => $reservations,
        ));
    }

    /**
     * @Route("reservation/delete/{id}" , name="reservation_delete")
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $reservation = $this->getDoctrine()->getRepository(Reservation::class)->find($id);
        if (!$reservation) {
            throw $this->createNotFoundException(
                'There are no reservation with the following id: ' . $id
            );
        }
        $em->remove($reservation);
        $em->flush();
        return $this->redirectToRoute('reservation', []);
    }

     /**
     * @Route("/user/reservation/annule/{id}", name="annulation_reservation")
     */
    public function indexAnnullerMyResevation($id): Response
    {
        $em= $this->getDoctrine()->getManager();
        $reservation=$em->getRepository(Reservation::class)->find($id);
        $reservation->setStatus("canceled");
        $em->persist($reservation);
        $em->flush();
        $reservations=$em->getRepository(Reservation::class)->findAll();
        $this->addFlash('message', 'la reservation a été annulé');        
        return $this->render('reservation/myreservation.html.twig', array(
            'controller_name' => 'ReservationController',
            'reservations' => $reservations,
        ));
    }

    /**
     * @Route("/reservation/generatePDF", name="reservation_pdf")
     */
    public function generatePDfofResevation(): Response
    {
        $em= $this->getDoctrine()->getManager();
        $reservations=$em->getRepository(Reservation::class)->findAll();
        $pdfOptions= new Options();
        $pdfOptions->set('defaultFont','Arial');
        $dompdf = new Dompdf($pdfOptions);
        $html = $this->renderView('reservation/pdf.html.twig', array(
            'reservations' => $reservations,
        ));
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        $dompdf->stream("mypdf.pdf",["Attachement" => true]);        
        return $this->redirectToRoute('reservation', []);
    }

    /**
     * @Route("/user/reservation/generatePDF", name="myreservation_pdf")
     */
    public function generatePDfofMyResevation(): Response
    {
        $em= $this->getDoctrine()->getManager();
        $reservations=$em->getRepository(Reservation::class)->findAll();
        $pdfOptions= new Options();
        $pdfOptions->set('defaultFont','Arial');
        $dompdf = new Dompdf($pdfOptions);
        $html = $this->renderView('reservation/pdf.html.twig', array(
            'reservations' => $reservations,
        ));
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        $dompdf->stream("mypdf.pdf",["Attachement" => true]);        
        return $this->redirectToRoute('my_reservation', []);
    }


}
