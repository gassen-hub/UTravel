<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

 use App\Entity\Activite;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\JsonResponse;
 use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
 use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\Json;

class ActiviteControllerJsonController extends AbstractController
{
     /******************Ajouter Reclamation*****************************************/
     /**
      * @Route("/addActivite", name="add_activite")
      * @Method("POST")
      */

      public function ajouterReclamationAction(Request $request)
      {
          $activite = new Activite();
          $nom_activite = $request->query->get("nom_activite");
          $type_activite = $request->query->get("type_activite");
          $prix_activite = $request->query->get("prix_activite");
          $nb_pers = $request->query->get("nb_pers");
          $date_debut = $request->query->get("date_debut");
          $date_fin = $request->query->get("date_fin");
          $fiche_descriptive = $request->query->get("fiche_descriptive");

          $em = $this->getDoctrine()->getManager();
         
 
          $activite->setNomActivite($nom_activite);
          $activite->setTypeActivite($type_activite);
          $activite->setNbPers($nb_pers);
          $activite->setDateDebut($date_debut);
          $activite->setDateFin($date_fin);
          $activite->setFicheDescriptive($fiche_descriptive);
          $activite->setPrixActivite($prix_activite);
         
         
 
          $em->persist($activite);
          $em->flush();
          $serializer = new Serializer([new ObjectNormalizer()]);
          $formatted = $serializer->normalize($activite);
          return new JsonResponse($formatted);
 
      }
 
      /******************Supprimer Reclamation*****************************************/
 
      /**
       * @Route("/deleteActivite", name="delete_activite")
       * @Method("DELETE")
       */
 
      public function deleteReclamationAction(Request $request) {
          $id = $request->get("id");
 
          $em = $this->getDoctrine()->getManager();
          $reclamation = $em->getRepository(Activite::class)->find($id);
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
      * @Route("/updateActivite", name="update_activite")
      * @Method("PUT")
      */
     public function modifierReclamationAction(Request $request) {
         $em = $this->getDoctrine()->getManager();
         $reclamation = $this->getDoctrine()->getManager()
                         ->getRepository(Reclamation::class)
                         ->find($request->get("id"));
 
         $reclamation->setObjet($request->get("objet"));
         $reclamation->setDescription($request->get("description"));
 
         $em->persist($reclamation);
         $em->flush();
         $serializer = new Serializer([new ObjectNormalizer()]);
         $formatted = $serializer->normalize($reclamation);
         return new JsonResponse("Reclamation a ete modifiee avec success.");
 
     }
 
 
 
     /******************affichage Reclamation*****************************************/
 
      /**
       * @Route("/displayActivite", name="display_activite")
       */
      public function allRecAction()
      {
 
          $reclamation = $this->getDoctrine()->getManager()->getRepository(Activite::class)->findAll();
          $serializer = new Serializer([new ObjectNormalizer()]);
          $formatted = $serializer->normalize($reclamation);
 
          return new JsonResponse($formatted);
 
      }
 
 
      /******************Detail Reclamation*****************************************/
 
      /**
       * @Route("/detailReclamation", name="detail_reclamation")
       * @Method("GET")
       */
 
      //Detail Reclamation
      public function detailReclamationAction(Request $request)
      {
          $id = $request->get("id");
 
          $em = $this->getDoctrine()->getManager();
          $reclamation = $this->getDoctrine()->getManager()->getRepository(Activite::class)->find($id);
          $encoder = new JsonEncoder();
          $normalizer = new ObjectNormalizer();
          $normalizer->setCircularReferenceHandler(function ($object) {
              return $object->getDescription();
          });
          $serializer = new Serializer([$normalizer], [$encoder]);
          $formatted = $serializer->normalize($reclamation);
          return new JsonResponse($formatted);
      }
 
}
