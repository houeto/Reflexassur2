<?php

namespace MainBundle\Controller;
use MainBundle\Entity\PoliceAssurance;
use MainBundle\Form\PoliceAssuranceType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PoliceAssuranceController extends Controller
{
    public function listePoliceAssuranceAction()
    {
        //Déclaration d'une varibale pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        
        //Déclaration d'un objet de type TarifAssuranceTemporaire
        $newPoliceAssurance = new PoliceAssurance();
        //Création du formulaire en passant l'objet TarifAssuranceTemporaire en paramètre
        $form = $this->createForm(new PoliceAssuranceType(), $newPoliceAssurance);
        //Requête pour vérifier si c'est un get ou post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') { //Post
            $form->bind($request);
            //Vérification si le modèle est valide
            if ($form->isValid()) {
                    //Instruction pour l'enregistrement
                    $em->persist($newPoliceAssurance);
                    //Mise à jour des informations
                    $em->flush();
                    //Affichage de l'information de l'enregistrement
                    $this->get('session')->getFlashBag()->add('success', 'Enregistrement ajouté avec succès');
                    return $this->redirect($this->generateUrl('police_assurance'));
            }
        }
        //Requête pour sélectionner la liste des tarifs d'assurance temporaire
        $policeassurances = $em->getRepository("MainBundle:PoliceAssurance")->findAll();
        //Retourne la vue
        return $this->render('MainBundle:Assurance:PoliceAssurance.html.twig', array(
                'form' => $form->createView(),
                'policeassurances' => $policeassurances
            ));    
        
    }    
    
    public function modifierPoliceAssuranceAction($id) {
        //Déclaration d'une variable pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        //recherche de l'objet à modifier par l'id
        $policeAssurance = $em->getRepository("MainBundle:PoliceAssurance")->find($id);
        
        //Création du formulaire en passant l'objet à modifier en paramètre
        $form = $this->createForm(new PoliceAssuranceType(), $policeAssurance);
        //Vérification de la méthode du formulaire si c'est un get ou un post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {//Post
            //Récupération du contenu du formulaire
            $form->bind($request);
            //Vérification si le formulaire est valide
            if ($form->isValid()) {
                //Instruction pour modifier
                $em->persist($policeAssurance);
                //Mise à jour
                $em->flush();
                //Affichage d'un message
                $this->get('session')->getFlashBag()->add('success', 'Enregistrement modifié avec succès');
                //Rédirection
                return $this->redirect($this->generateUrl('police_assurance'));
            }
        }
        //Requête pour récupérer la liste des polices d'assurance
        $policeassurances = $em->getRepository("MainBundle:PoliceAssurance")->findAll();
        return $this->render('MainBundle:Assurance:PoliceAssurance.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'policeassurances' => $policeassurances
        ));
    }    
    
    public function supprimerPoliceAssuranceAction($id) {
        //Récupération du modèle
        $em = $this->getDoctrine()->getManager();
        //Recherche de l'objet à supprimer
        $policeAssurance = $em->getRepository("MainBundle:PoliceAssurance")->find($id);
        //Tester le résultat
        if ($policeAssurance) {
            //Suppression
            $em->remove($policeAssurance);
            //Mise à jour des informations
            $em->flush();
            //Affichage de message
            $this->get('session')->getFlashBag()->add('success', 'Enregistrement supprimé avec succès');
            //Rédirection 
            return $this->redirect($this->generateUrl('police_assurance'));
        } else {//Objet non trouvé
            //Affichage de message
            $this->get('session')->getFlashBag()->add('error', 'Cet enregistrement n\'existe plus');
            //Rédirection
            return $this->redirect($this->generateUrl('police_assurance'));
        }
    }
}
