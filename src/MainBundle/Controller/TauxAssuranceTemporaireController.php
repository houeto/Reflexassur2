<?php

namespace MainBundle\Controller;
use MainBundle\Entity\TauxAssuranceTemporaire;
use MainBundle\Form\TauxAssuranceTemporaireType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TauxAssuranceTemporaireController extends Controller
{
    public function listeTauxAssuranceTemporaireAction()
    {
        //Déclaration d'une varibale pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        
        //Déclaration d'un objet de type TauxAssuranceTemporaire
        $newTauxAssuranceTemporaire = new TauxAssuranceTemporaire();
        //Création du formulaire en passant l'objet TauxAssuranceTemporaire en paramètre
        $form = $this->createForm(new TauxAssuranceTemporaireType(), $newTauxAssuranceTemporaire);
        //Requête pour vérifier si c'est un get ou post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') { //Post
            $form->bind($request);
            //Vérification si le modèle est valide
            if ($form->isValid()) {
                $taux = $em
                    ->getRepository("MainBundle:TauxAssuranceTemporaire")
                    ->findBy(array("bornInf" => $newTauxAssuranceTemporaire->getBornInf(),
                                    "bornSup" => $newTauxAssuranceTemporaire->getBornSup(),
                                    "tauxDouble" => $newTauxAssuranceTemporaire->getTauxDouble()
                        ));
                if($taux){
                    $this->get('session')->getFlashBag()->add('error', 'Ce Taux assurance temporaire existe déjà.');
                    return $this->redirect($this->generateUrl('taux_assurance_temporaire'));
                }
                if($newTauxAssuranceTemporaire->getBornSup() < $newTauxAssuranceTemporaire->getBornInf()){
                    $this->get('session')->getFlashBag()->add('error', 'La borne inférieure ne peut etre supérieure à la borne supérieure.');
                    return $this->redirect($this->generateUrl('taux_assurance_temporaire'));
                }
                
                
                
                    //Instruction pour l'enregistrement
                    $em->persist($newTauxAssuranceTemporaire);
                    //Mise à jour des informations
                    $em->flush();
                    //Affichage de l'information de l'enregistrement
                    $this->get('session')->getFlashBag()->add('success', 'Enregistrement ajouté avec succès');
                    return $this->redirect($this->generateUrl('taux_assurance_temporaire'));
            }
        }
        //Requête pour sélectionner la liste des taux d'assurance temporaire
        $tauxassurancetemporaires = $em->getRepository("MainBundle:TauxAssuranceTemporaire")->findAll();
        //Retourne la vue
        return $this->render('MainBundle:Assurance:TauxAssuranceTemporaire.html.twig', array(
                'form' => $form->createView(),
                'tauxassurancetemporaires' => $tauxassurancetemporaires
            ));    
        
    }    
    
    public function modifierTauxAssuranceTemporaireAction($id) {
        //Déclaration d'une variable pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        //recherche de l'objet à modifier par l'id
        $tauxassurancetemporaire = $em->getRepository("MainBundle:TauxAssuranceTemporaire")->find($id);
        
        //Création du formulaire en passant l'objet à modifier en paramètre
        $form = $this->createForm(new TauxAssuranceTemporaireType(), $tauxassurancetemporaire);
        //Vérification de la méthode du formulaire si c'est un get ou un post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {//Post
            //Récupération du contenu du formulaire
            $form->bind($request);
            //Vérification si le formulaire est valide
            if ($form->isValid()) {
                $taux = $em
                    ->getRepository("MainBundle:TauxAssuranceTemporaire")
                    ->findBy(array("bornInf" => $tauxassurancetemporaire->getBornInf(),
                                    "bornSup" => $tauxassurancetemporaire->getBornSup(),
                                    "tauxDouble" => $tauxassurancetemporaire->getTauxDouble()
                        ));
                if($taux){
                    $this->get('session')->getFlashBag()->add('error', 'Ce Taux assurance temporaire existe déjà.');
                    return $this->redirect($this->generateUrl('taux_assurance_temporaire'));
                }
                if($tauxassurancetemporaire->getBornSup() < $tauxassurancetemporaire->getBornInf()){
                    $this->get('session')->getFlashBag()->add('error', 'La borne inférieure ne peut etre supérieure à la borne supérieure.');
                    return $this->redirect($this->generateUrl('taux_assurance_temporaire'));
                }
                //Instruction pour modifier
                $em->persist($tauxassurancetemporaire);
                //Mise à jour
                $em->flush();
                //Affichage d'un message
                $this->get('session')->getFlashBag()->add('success', 'Enregistrement modifié avec succès');
                //Rédirection
                return $this->redirect($this->generateUrl('taux_assurance_temporaire'));
            }
        }
        //Requête pour récupérer la liste des polices d'assurance
        $tauxassurancetemporaires = $em->getRepository("MainBundle:TauxAssuranceTemporaire")->findAll();
        return $this->render('MainBundle:Assurance:TauxAssuranceTemporaire.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'tauxassurancetemporaires' => $tauxassurancetemporaires
        ));
    }    
    
    public function supprimerTauxAssuranceTemporaireAction($id) {
        //Récupération du modèle
        $em = $this->getDoctrine()->getManager();
        //Recherche de l'objet à supprimer
        $tauxAssuranceTemporaire = $em->getRepository("MainBundle:TauxAssuranceTemporaire")->find($id);
        //Tester le résultat
        if ($tauxAssuranceTemporaire) {
            $tarif = $em->getRepository("MainBundle:TarifAssuranceTemporaire")->findByTauxAssuranceTemporaire($tauxAssuranceTemporaire);
            if($tarif){
                $this->get('session')->getFlashBag()->add('error', 'Ce taux assurance temporaire est lié à une tarification, Vous ne pouvez donc pas le supprimer!');
                return $this->redirect($this->generateUrl('taux_assurance_temporaire'));
            }else{
                //Suppression
                $em->remove($tauxAssuranceTemporaire);
                //Mise à jour des informations
                $em->flush();
                //Affichage de message
                $this->get('session')->getFlashBag()->add('success', 'Enregistrement supprimé avec succès');
                //Rédirection 
                return $this->redirect($this->generateUrl('taux_assurance_temporaire'));
            } 
           
        } else {//Objet non trouvé
            //Affichage de message
            $this->get('session')->getFlashBag()->add('error', 'Cet enregistrement n\'existe plus');
            //Rédirection
            return $this->redirect($this->generateUrl('taux_assurance_temporaire'));
        }
    }
}
