<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Hotel;
use App\Form\HotelType;
use App\Repository\HotelRepository;

class HotelController extends AbstractController
{


/**
 * @Route("/hotel/list", name="listh")
 */
public function list(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Hotel::class);
        $hotels=$rep->findAll();
        return $this->render('hotel/list.html.twig', [
            'hotel' => $hotels,
        ]);

    }
    /**
     * @Route("/hotel/delete/{id}", name="deleteh")
     */
    public function delete($id): Response
    {
        $rep = $this->getDoctrine()->getRepository(Hotel::class);
        $em = $this->getDoctrine()->getManager();
        $hotel = $rep->find($id);
        $em->remove($hotel);
        $em->flush();
        return $this->redirectToRoute('listh');

    }
    /**
     * @Route("/hotel/update/{id}", name="updateh")
     */
    public function update(Request $request,$id): Response
    {
        $rep=$this->getDoctrine()->getRepository(Hotel::class);

        $hotel=$rep->find($id);
        $form=$this->createForm(HotelType::class,$hotel);
        $form=$form->handleRequest($request);
        if ($form->isSubmitted())
        {

            $em=$this->getDoctrine()->getManager();
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
        $hotel=new Hotel();
        $form=$this->createForm(HotelType::class,$hotel);
        $form=$form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $hotel=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($hotel);
            $em->flush();
            return $this->redirectToRoute('listh');

        }
        return $this->render('hotel/add.html.twig', [
            'formA' => $form->createView(),

        ]);
    }
}