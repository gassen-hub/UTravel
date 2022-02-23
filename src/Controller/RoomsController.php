<?php

namespace App\Controller;

use App\Entity\Rooms;
use App\Form\RoomsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\RoomsRepository;
class RoomsController extends AbstractController
{
    /**
     * @Route("/rooms/list", name="listR")
     */
    public function list(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Rooms::class);
        $Rooms=$rep->findAll();
        return $this->render('rooms/list.html.twig', [
            'Rooms' => $Rooms,
        ]);

    }
    /**
     * @Route("/rooms/delete/{id}", name="deleteR")
     */
    public function delete($id): Response
    {
        $rep = $this->getDoctrine()->getRepository(Rooms::class);
        $em = $this->getDoctrine()->getManager();
        $Rooms = $rep->find($id);
        $em->remove($Rooms);
        $em->flush();
        return $this->redirectToRoute('listR');

    }
    /**
     * @Route("/rooms/update/{id}", name="updateR")
     */
    public function update(Request $request,$id): Response
    {
        $rep=$this->getDoctrine()->getRepository(rooms::class);

        $rooms=$rep->find($id);
        $form=$this->createForm(RoomsType::class,$rooms);
        $form=$form->handleRequest($request);
        if ($form->isSubmitted())
        {

            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listR');


        }
        return $this->render('rooms/update.html.twig', [
            'formA' => $form->createView(),
        ]);


    }
        /**
         * @Route("/rooms/addR", name="addR")
         */
        public function add(Request $request): Response
    {
        $Rooms=new Rooms();
        $form=$this->createForm(RoomsType::class,$Rooms);
        $form=$form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $Rooms=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($Rooms);
            $em->flush();
            return $this->redirectToRoute('listR');

        }
        return $this->render('rooms/add.html.twig', [
            'formA' => $form->createView(),

        ]);
    }

    }

