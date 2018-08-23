<?php

namespace MainBundle\Controller;
use MainBundle\Entity\Lister;
use MainBundle\Entity\Compagnie;
use MainBundle\Form\ListerType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListerController extends Controller
{
    public function listeListerAction()
    {
        //Déclaration d'une varibale pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        
        //Déclaration d'un objet de type Lister
        $newLister = new Lister();
        //Création du formulaire en passant l'objet Lister en paramètre
        $form = $this->createForm(new ListerType(), $newLister);
        //Requête pour vérifier si c'est un get ou post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') { //Post
            $form->bind($request);
            //Vérification si le modèle est valide
            if ($form->isValid()) {
                //Vérification de doublon
                //Doublon sur le nom de l'agence
                $Lister_doublon = $em ->getRepository("MainBundle:Lister")->findBylistOblig($newLister->getListOblig());
                if($Lister_doublon){
                    $this->get('session')->getFlashBag()->add('error', 'Cet enregistrement existe déjà.');
                    return $this->redirect($this->generateUrl('lister'));
                }                
                    //Instruction pour l'enregistrement
                    $em->persist($newLister);
                    //Mise à jour des informations
                    $em->flush();
                    //Affichage de l'information de l'enregistrement
                    $this->get('session')->getFlashBag()->add('success', 'Enregistrement ajouté avec succès');
                    return $this->redirect($this->generateUrl('lister'));   
            }
        }
        //Requête pour sélectionner la liste des polices d'assurance
        $lister = $em->getRepository("MainBundle:Lister")->findAll();
        //Retourne la vue
        return $this->render('MainBundle:Actions:Lister.html.twig', array(
                'form' => $form->createView(),
                'lister' => $lister
            ));    
        
    }    
    
    public function modifierListerAction($id) {
        //Déclaration d'une variable pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        //recherche de l'objet à modifier par l'id
        $lister = $em->getRepository("MainBundle:Lister")->find($id);
        
        //Création du formulaire en passant l'objet à modifier en paramètre
        $form = $this->createForm(new ListerType(), $lister);
        //Vérification de la méthode du formulaire si c'est un get ou un post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {//Post
            //Récupération du contenu du formulaire
            $form->bind($request);
            //Vérification si le formulaire est valide
            if ($form->isValid()) {
                //Instruction pour modifier
                $em->persist($lister);
                //Mise à jour
                $em->flush();
                //Affichage d'un message
                $this->get('session')->getFlashBag()->add('success', 'Enregistrement modifié avec succès');
                //Rédirection
                return $this->redirect($this->generateUrl('lister'));
            }
        }
        //Requête pour récupérer la liste des polices d'assurance
        $lister = $em->getRepository("MainBundle:Lister")->findAll();
        return $this->render('MainBundle:Actions:Lister.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'lister' => $lister
        ));
    }    
    
    public function supprimerListerAction($id) {
        //Récupération du modèle
        $em = $this->getDoctrine()->getManager();
        //Recherche de l'objet à supprimer
        $lister = $em->getRepository("MainBundle:Lister")->find($id);
        //Tester le résultat
        if ($lister) {
            //Suppression
            $em->remove($lister);
            //Mise à jour des informations
            $em->flush();
            //Affichage de message
            $this->get('session')->getFlashBag()->add('success', 'Enregistrement supprimé avec succès');
            //Rédirection 
            return $this->redirect($this->generateUrl('lister'));
        } else {//Objet non trouvé
            //Affichage de message
            $this->get('session')->getFlashBag()->add('error', 'Cet enregistrement n\'existe plus');
            //Rédirection
            return $this->redirect($this->generateUrl('lister'));
        }
    }
}
