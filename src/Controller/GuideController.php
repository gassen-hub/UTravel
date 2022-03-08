<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Entity\Guide;

class GuideController extends AbstractController
{
    /**
     * @Route("/guide", name="guide")
     */
    public function index(): Response
    {
        $guide = new Guide();
        $form = $this->createFormBuilder($guide)
            ->add('name', TextType::class, ['constraints' => new NotBlank([]),])
            ->add('age', IntegerType::class, ['constraints' => new NotBlank(),])
            ->add('save', SubmitType::class, ['label' => 'Search'])
            ->getForm();
        $em= $this->getDoctrine()->getManager();
        $guides=$this->getDoctrine()->getManager()->getRepository(Guide::class)->findAll();        
        return $this->render('guide/index.html.twig', array(
            'controller_name' => 'GuideController',
            'guides' => $guides,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/guide/new")
     */
    public function createAction(Request $request) {
        $guide = new Guide();
        $form = $this->createFormBuilder($guide)
            ->add('name', TextType::class, ['constraints' => new NotBlank([]),])
            ->add('age', IntegerType::class, ['constraints' => new NotBlank(),])
            ->add('save', SubmitType::class, ['label' => 'Valider'])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $guide = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($guide);
            $em->flush();
            echo 'Envoyé';
        }
        return $this->render('guide/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("guide/edit/{id}", name="guide_edit")
     */
    public function updateAction(Request $request, $id) {
        $guide = $this->getDoctrine()->getRepository(Guide::class);
        $guide = $guide->find($id);
        if (!$guide) {
            throw $this->createNotFoundException(
                'There are no guide with the following id: ' . $id
            );
        }
        $form = $this->createFormBuilder($guide)
            ->add('name', TextType::class,['constraints' => new NotBlank([]),])
            ->add('age', IntegerType::class,['constraints' => new NotBlank([]),])
            ->add('save', SubmitType::class, array('label' => 'Editer'))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $article = $form->getData();
            $em->flush();
            return $this->redirect($this->generateUrl('guide'));
        }
        return $this->render(
            'guide/edit.html.twig',
            array('form' => $form->createView())
        );
    }


    /**
     * @Route("guide/delete/{id}" , name="guide_delete")
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $guide = $this->getDoctrine()->getRepository(Guide::class);
        $guide = $guide->find($id);
        if (!$guide) {
            throw $this->createNotFoundException(
                'There are no guide with the following id: ' . $id
            );
        }
        $em->remove($guide);
        $em->flush();
        return $this->redirect($this->generateUrl('guide'));
    }

    /**
     * @Route("guide/{id}/trips" , name="guide_trips")
     */
    public function guideTripsAction($id) {
        $em = $this->getDoctrine()->getManager();
        $guide = $this->getDoctrine()->getRepository(Guide::class);
        $guide = $guide->find($id);
        if (!$guide) {
            throw $this->createNotFoundException(
                'There are no guide with the following id: ' . $id
            );
        }
        return $this->render('trip/index.html.twig', array(
            'trips' => $guide->getTrips(),
            'guide'=> $id
        ));
    }
}
