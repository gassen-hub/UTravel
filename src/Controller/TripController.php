<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Entity\Guide;
use App\Entity\Trip;

class TripController extends AbstractController
{
    /**
     * @Route("/trip", name="trip")
     */
    public function index(): Response
    {
        return $this->render('trip/index.html.twig', [
            'controller_name' => 'TripController',
        ]);
    }

     /**
     * @Route("/guide/{id}/trip/new", name="createTrip")
     */
    public function createAction(Request $request, $id) {
        $guide = $this->getDoctrine()->getRepository(Guide::class);
        $guide = $guide->find($id);
        $trip = new Trip();
        $trip->setGuide($guide);
        $form = $this->createFormBuilder($trip)
            ->add('name', TextType::class,['constraints' => new NotBlank([]),])
            ->add('date', DateType::class,['constraints' => new NotBlank([]),])
            ->add('nbSejour', TextType::class,['constraints' => new NotBlank([]),])
            ->add('prix', TextType::class,['constraints' => new NotBlank([]),])
            ->add('save', SubmitType::class, ['label' => 'Valider'])
            ->getForm();           
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $trip = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($trip);
            $em->flush();
            echo 'Envoyé';
        }
        return $this->render('trip/new.html.twig', [
            'form' => $form->createView(),
            'guide' => $id
        ]);
    }

   /**
     * @Route("/guide/{id}/trips/edit/{idTrips}" , name="trip_edit")
     */
    public function updateAction(Request $request, $id,$idTrips) {
        $trip = $this->getDoctrine()->getRepository(Trip::class);
        $trip = $trip->find($idTrips);
        if (!$trip) {
            throw $this->createNotFoundException(
                'There are no trip with the following id: ' . $idTrips
            );
        }
        $form = $this->createFormBuilder($trip)
        ->add('name', TextType::class,['constraints' => new NotBlank([]),])
        ->add('date', DateType::class,['constraints' => new NotBlank([]),])
        ->add('nbSejour', TextType::class,['constraints' => new NotBlank([]),])
        ->add('prix', TextType::class,['constraints' => new NotBlank([]),])
            ->add('save', SubmitType::class, array('label' => 'Editer'))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $trip = $form->getData();
            $em->flush();
            //return $this->redirect($this->generateUrl('trip'));
            return $this->redirectToRoute('guide_trips', [
                'id' =>$id
            ]);
        }
        return $this->render(
            'trip/edit.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/guide/{id}/trips/delete/{idTrips}" , name="trip_delete")
     */
    public function deleteAction($id,$idTrips) {
        $em = $this->getDoctrine()->getManager();
        $trip = $this->getDoctrine()->getRepository(Trip::class);
        $trip =$trip->find($idTrips);
        if (!$trip) {
            throw $this->createNotFoundException(
                'There are no trip with the following id: ' . $idTrips
            );
        }
        $em->remove($trip);
        $em->flush();
        return $this->redirectToRoute('guide_trips', [
            'id' =>$id
        ]);
    }
}
