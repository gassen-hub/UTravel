<?php

namespace App\Controller;

use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Reservation;
use App\Repository\ReservationRepository;
class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation/list", name="listr")
     */
    public function list(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Reservation::class);
        $Reservations=$rep->findAll();
        return $this->render('Reservation/list.html.twig', [
            'Reservation' => $Reservations,
        ]);

    }
    /**
     * @Route("/reservation/delete/{id}", name="deleter")
     */
    public function delete($id): Response
    {
        $rep = $this->getDoctrine()->getRepository(Reservation::class);
        $em = $this->getDoctrine()->getManager();
        $Reservation = $rep->find($id);
        $em->remove($Reservation);
        $em->flush();
        return $this->redirectToRoute('listr');

    }
    /**
     * @Route("/reservation/update/{id}", name="updater")
     */
    public function update(Request $request,$id): Response
    {
        $rep=$this->getDoctrine()->getRepository(reservation::class);

        $reservation=$rep->find($id);
        $form=$this->createForm(ReservationType::class,$reservation);
        $form=$form->handleRequest($request);
        if ($form->isSubmitted())
        {

            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listr');

        }
        return $this->render('reservation/update.html.twig', [
            'formA' => $form->createView(),
        ]);

    }
    /**
     * @Route("/reservation/add", name="addr")
     */
    public function add(Request $request): Response
    {
        $reservation=new Reservation();
        $form=$this->createForm(ReservationType::class,$reservation);
        $form=$form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $reservation=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute('listr');

        }
        return $this->render('reservation/add.html.twig', [
            'formA' => $form->createView(),

        ]);
    }
}
