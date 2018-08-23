<?php

namespace MainBundle\Controller;
use MainBundle\Entity\Agence;
use MainBundle\Form\AgenceType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AgenceController extends Controller
{
      public function listeAgenceAction()
    {
        //Déclaration d'une varibale pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        
        //Déclaration d'un objet de type agence
        $newAgence = new Agence();
        //Création du formulaire en passant l'objet agence en paramètre
        $form = $this->createForm(new AgenceType(), $newAgence);
        //Requête pour vérifier si c'est un get ou post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') { //Post
            $form->bind($request);
            //Vérification si le modèle est valide
            if ($form->isValid()) {
                //Vérification de doublon
                //Doublon sur le nom de l'agence
                $Agence_doublon = $em ->getRepository("MainBundle:Agence")->findBymon($newAgence->getMon());
                if($Agence_doublon){
                    $this->get('session')->getFlashBag()->add('error', 'Cette agence existe déjà.');
                    return $this->redirect($this->generateUrl('agence'));
                }
                
                //Doublon sur le téléphone de l'agence
                $Agence_doublon = $em ->getRepository("MainBundle:Agence")->findByTelephone($newAgence->gettelephone());
                if($Agence_doublon){
                    $this->get('session')->getFlashBag()->add('error', 'Une agence est déjà enregistrée avec ce numéro de téléphone.');
                    return $this->redirect($this->generateUrl('agence'));
                }
                
                    //Instruction pour l'enregistrement
                    $em->persist($newAgence);
                    //Mise à jour des informations
                    $em->flush();
                    //Affichage de l'information de l'enregistrement
                    $this->get('session')->getFlashBag()->add('success', 'Agence ajoutée avec succès');
                    return $this->redirect($this->generateUrl('agence'));   
            }
        }
        //Requête pour sélectionner la liste des agences
        $agences = $em->getRepository("MainBundle:Agence")->findAll();
        //Retourne la vue
        return $this->render('MainBundle:Assurance:Agence.html.twig', array(
                'form' => $form->createView(),
                'agences' => $agences
            ));    
        
    }
    
    
    
    public function modifierAgenceAction($id) {
        //Déclaration d'une variable pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        //recherche de l'objet à modifier par l'id
        $agence = $em->getRepository("MainBundle:Agence")->find($id);
        
        //Création du formulaire en passant l'objet à modifier en paramètre
        $form = $this->createForm(new AgenceType(), $agence);
        //Vérification de la méthode du formulaire si c'est un get ou un post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {//Post
            //Récupération du contenu du formulaire
            $form->bind($request);
            //Vérification si le formulaire est valide
            if ($form->isValid()) {
              
//                $Agence_doublon = $em ->getRepository("MainBundle:Agence")->findBymon($agence->getMon());
//                if($Agence_doublon){
//                    $this->get('session')->getFlashBag()->add('error', 'Cette agence existe déjà.');
//                    return $this->redirect($this->generateUrl('agence'));
//                }
//                
//                //Doublon sur le téléphone de l'agence
//                $Agence_doublon = $em ->getRepository("MainBundle:Agence")->findBytelephone($agence->getTelephone());
//                if($Agence_doublon){
//                    $this->get('session')->getFlashBag()->add('error', 'Une agence est déjà enregistrée avec ce numéro de téléphone.');
//                    return $this->redirect($this->generateUrl('agence'));
//                }
                //Instruction pour modifier
                $em->persist($agence);
                //Mise à jour
                $em->flush();
                //Affichage d'un message
                $this->get('session')->getFlashBag()->add('success', 'Agence modifiée avec succès');
                //Rédirection
                return $this->redirect($this->generateUrl('agence'));
            }
        }
        //Requête pour récupérer la liste des agences
        $agences = $em->getRepository("MainBundle:Agence")->findAll();
        return $this->render('MainBundle:Assurance:Agence.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'agences' => $agences
        ));
    }
    
    
    
    public function supprimerAgenceAction($id) {
        //Récupération du modèle
        $em = $this->getDoctrine()->getManager();
        //Recherche de l'objet à supprimer
        $agence = $em->getRepository("MainBundle:Agence")->find($id);
        //Tester le résultat
        if ($agence) {
            $policeAssurance = $em->getRepository("MainBundle:PoliceAssurance")->findByAgence($agence);
            if($policeAssurance){
                $this->get('session')->getFlashBag()->add('error', 'Cette agence est liée à une police d\'assurance, Vous ne pouvez donc pas la supprimer!');
                return $this->redirect($this->generateUrl('agence'));
            }else{
                //Suppression
                $em->remove($agence);
                //Mise à jour des informations
                $em->flush();
                //Affichage de message
                $this->get('session')->getFlashBag()->add('success', 'Agence supprimée avec succès');
                //Rédirection 
                return $this->redirect($this->generateUrl('agence'));
            } 
            
        } else {//Objet non trouvé
            //Affichage de message
            $this->get('session')->getFlashBag()->add('error', 'Cette agence n\'existe plus');
            //Rédirection
            return $this->redirect($this->generateUrl('agence'));
        }
    }
}


