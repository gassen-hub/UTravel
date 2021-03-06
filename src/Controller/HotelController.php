<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Form\HotelType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\HotelRepository;

class HotelController extends AbstractController
{
    /**
     * @Route("/hotel/list", name="listh")
     */
    public function list(): Response
    {
        $rep = $this->getDoctrine()->getRepository(Hotel::class);
        $Hotel = $rep->findAll();
        return $this->render('Hotel/list.html.twig', [
            'Hotel' => $Hotel,
        ]);

    }

    /**
     * @Route("/hotel/delete/{id}", name="deleteh")
     */
    public function delete($id): Response
    {
        $rep = $this->getDoctrine()->getRepository(Hotel::class);
        $em = $this->getDoctrine()->getManager();
        $Hotel = $rep->find($id);
        $em->remove($Hotel);
        $em->flush();
        return $this->redirectToRoute('listh');

    }

    /**
     * @Route("/hotel/update/{id}", name="updateh")
     */
    public function update(Request $request, $id): Response
    {
        $rep = $this->getDoctrine()->getRepository(Hotel::class);

        $Hotel = $rep->find($id);
        $form = $this->createForm(HotelType::class, $Hotel);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listh');

        }
        return $this->render('hotel/update.html.twig', [
            'formA' => $form->createView(),
        ]);

    }

    /**
     * @Route("/hotel/add", name="addh")
     */
    public function add(Request $request): Response
    {
        $Hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $Hotel);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $Hotel = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($Hotel);
            $em->flush();
            return $this->redirectToRoute('listh');

        }
        return $this->render('hotel/add.html.twig', [
            'formA' => $form->createView(),

        ]);
    }
    /**
     * @Route("/hotel/details/{id}", name="details")
     */
    public function details(Request $request, $id): Response
    {
        $rep = $this->getDoctrine()->getRepository(Hotel::class);
        $Hotel = $rep->find($id);
        return $this->render('details.html.twig', [
            'Hotel' => $Hotel,
        ]);

    }

}
