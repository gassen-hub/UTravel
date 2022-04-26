<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

 use App\Entity\Activite;
use App\Entity\Endroit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\JsonResponse;
 use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
 use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\Json;

class EndroitControllerJsonController extends AbstractController
{
  
    /******************Ajouter Reclamation*****************************************/
     /**
      * @Route("/addEndroit", name="add_endroit")
      * @Method("POST")
      */

      public function ajouterEndroit(Request $request)
      {
          $endroit = new Endroit();
          $nom_endroit = $request->query->get("nom_endroit");
          $adresse = $request->query->get("adresse");
          $disponibilite = $request->query->get("disponibilite");
          $horaire = $request->query->get("horaire");
          $prix = $request->query->get("prix");
          $latitude = $request->query->get("latitude");
          $longitude = $request->query->get("longitude");
          $categorie = $request->query->get("categorie");

          $em = $this->getDoctrine()->getManager();
         $endroit->setNomEndroit($nom_endroit);
          $endroit->setAdresse($adresse);
          $endroit->setDisponibilite($disponibilite);
          $endroit->setHoraire($horaire);
          $endroit->setPrix($prix);
          $endroit->setLatitude($latitude);
          $endroit->setLongitude($longitude);
          $endroit->setCategories($categorie);
         
         
 
          $em->persist($endroit);
          $em->flush();
          $serializer = new Serializer([new ObjectNormalizer()]);
          $formatted = $serializer->normalize($endroit);
          return new JsonResponse($formatted);
 
      }
 
      /******************Supprimer Reclamation*****************************************/
 
      /**
       * @Route("/deleteEndroit", name="delete_endroit")
       * @Method("DELETE")
       */
 
      public function deleteReclamationAction(Request $request) {
          $id = $request->get("id");
 
          $em = $this->getDoctrine()->getManager();
          $reclamation = $em->getRepository(Endroit::class)->find($id);
          if($reclamation!=null ) {
              $em->remove($reclamation);
              $em->flush();
 
              $serialize = new Serializer([new ObjectNormalizer()]);
              $formatted = $serialize->normalize("Activite a ete supprimee avec success.");
              return new JsonResponse($formatted);
 
          }
          return new JsonResponse("id reclamation invalide.");
 
 
      }
 
     /******************Modifier Reclamation*****************************************/
     /**
      * @Route("/updateEndroit", name="update_endroit")
      * @Method("PUT")
      */
     public function modifierReclamationAction(Request $request) {
         $em = $this->getDoctrine()->getManager();
         $endroit = $this->getDoctrine()->getManager()
                         ->getRepository(Endroit::class)
                         ->find($request->get("id"));
 
         $endroit->setObjet($request->get("objet"));
         $endroit->setDescription($request->get("description"));
 
         $em->persist($endroit);
         $em->flush();
         $serializer = new Serializer([new ObjectNormalizer()]);
         $formatted = $serializer->normalize($endroit);
         return new JsonResponse("Reclamation a ete modifiee avec success.");
 
     }
 
 
 
     /******************affichage Reclamation*****************************************/
 
      /**
       * @Route("/displayEndroit", name="display_endroit")
       */
      public function allRecAction()
      {
 
          $endroit = $this->getDoctrine()->getManager()->getRepository(Endroit::class)->findAll();
          $serializer = new Serializer([new ObjectNormalizer()]);
          $formatted = $serializer->normalize($endroit);
 
          return new JsonResponse($formatted);
 
      }
 
 
      /******************Detail Reclamation*****************************************/
 
      /**
       * @Route("/detailEndroit", name="detail_Endroit")
       * @Method("GET")
       */
 
      //Detail Reclamation
      public function detailReclamationAction(Request $request)
      {
          $id = $request->get("id");
 
          $em = $this->getDoctrine()->getManager();
          $endroit = $this->getDoctrine()->getManager()->getRepository(Endroit::class)->find($id);
          $encoder = new JsonEncoder();
          $normalizer = new ObjectNormalizer();
          $normalizer->setCircularReferenceHandler(function ($object) {
              return $object->getDescription();
          });
          $serializer = new Serializer([$normalizer], [$encoder]);
          $formatted = $serializer->normalize($endroit);
          return new JsonResponse($formatted);
      }
}
