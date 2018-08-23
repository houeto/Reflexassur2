<?php

namespace MainBundle\Controller;
use MainBundle\Entity\TarifAssuranceTemporaire;
use MainBundle\Form\TarifAssuranceTemporaireType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TarifAssuranceTemporaireController extends Controller
{
    public function listeTarifAssuranceTemporaireAction()
    {
        //Déclaration d'une varibale pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        
        //Déclaration d'un objet de type TarifAssuranceTemporaire
        $newTarifAssuranceTemporaire = new TarifAssuranceTemporaire();
        //Création du formulaire en passant l'objet TarifAssuranceTemporaire en paramètre
        $form = $this->createForm(new TarifAssuranceTemporaireType(), $newTarifAssuranceTemporaire);
        //Requête pour vérifier si c'est un get ou post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') { //Post
            $form->bind($request);
            //Vérification si le modèle est valide
            if ($form->isValid()) {
                    $tarif = $em
                        ->getRepository("MainBundle:TarifAssuranceTemporaire")
                        ->findBy(array(
                                        "tauxAssuranceTemporaire" => $newTarifAssuranceTemporaire->getTauxAssuranceTemporaire()
                            ));
                    if($tarif){
                        $this->get('session')->getFlashBag()->add('error', 'Ce Tarif assurance temporaire existe déjà.');
                        return $this->redirect($this->generateUrl('tarif_assurance_temporaire'));
                    }
                    //Instruction pour l'enregistrement
                    $em->persist($newTarifAssuranceTemporaire);
                    //Mise à jour des informations
                    $em->flush();
                    //Affichage de l'information de l'enregistrement
                    $this->get('session')->getFlashBag()->add('success', 'Enregistrement ajouté avec succès');
                    return $this->redirect($this->generateUrl('tarif_assurance_temporaire'));
            }
        }
        //Requête pour sélectionner la liste des tarifs d'assurance temporaire
        $tarifassurancetemporaires = $em->getRepository("MainBundle:TarifAssuranceTemporaire")->findAll();
        //Retourne la vue
        return $this->render('MainBundle:Tarif:TarifAssuranceTemporaire.html.twig', array(
                'form' => $form->createView(),
                'tarifassurancetemporaires' => $tarifassurancetemporaires
            ));    
        
    }    
    
    public function modifierTarifAssuranceTemporaireAction($id) {
        //Déclaration d'une variable pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        //recherche de l'objet à modifier par l'id
        $tarifassurancetemporaire = $em->getRepository("MainBundle:TarifAssuranceTemporaire")->find($id);
        
        //Création du formulaire en passant l'objet à modifier en paramètre
        $form = $this->createForm(new TarifAssuranceTemporaireType(), $tarifassurancetemporaire);
        //Vérification de la méthode du formulaire si c'est un get ou un post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {//Post
            //Récupération du contenu du formulaire
            $form->bind($request);
            //Vérification si le formulaire est valide
            if ($form->isValid()) {
                $tarif = $em
                    ->getRepository("MainBundle:TarifAssuranceTemporaire")
                    ->findBy(array(
                                    "tauxAssuranceTemporaire" => $tarifassurancetemporaire->getTauxAssuranceTemporaire()
                        ));
                if($tarif){
                    $this->get('session')->getFlashBag()->add('error', 'Ce Tarif assurance temporaire existe déjà.');
                    return $this->redirect($this->generateUrl('tarif_assurance_temporaire'));
                }
                //Instruction pour modifier
                $em->persist($tarifassurancetemporaire);
                //Mise à jour
                $em->flush();
                //Affichage d'un message
                $this->get('session')->getFlashBag()->add('success', 'Enregistrement modifié avec succès');
                //Rédirection
                return $this->redirect($this->generateUrl('tarif_assurance_temporaire'));
            }
        }
        //Requête pour récupérer la liste des polices d'assurance
        $tarifassurancetemporaires = $em->getRepository("MainBundle:TarifAssuranceTemporaire")->findAll();
        return $this->render('MainBundle:Tarif:TarifAssuranceTemporaire.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'tarifassurancetemporaires' => $tarifassurancetemporaires
        ));
    }    
    
    public function supprimerTarifAssuranceTemporaireAction($id) {
        //Récupération du modèle
        $em = $this->getDoctrine()->getManager();
        //Recherche de l'objet à supprimer
        $tarifassurancetemporaire = $em->getRepository("MainBundle:TarifAssuranceTemporaire")->find($id);
        //Tester le résultat
        if ($tarifassurancetemporaire) {
            //Suppression
            $em->remove($tarifassurancetemporaire);
            //Mise à jour des informations
            $em->flush();
            //Affichage de message
            $this->get('session')->getFlashBag()->add('success', 'Enregistrement supprimé avec succès');
            //Rédirection 
            return $this->redirect($this->generateUrl('tarif_assurance_temporaire'));
        } else {//Objet non trouvé
            //Affichage de message
            $this->get('session')->getFlashBag()->add('error', 'Cet enregistrement n\'existe plus');
            //Rédirection
            return $this->redirect($this->generateUrl('tarif_assurance_temporaire'));
        }
    }
}
