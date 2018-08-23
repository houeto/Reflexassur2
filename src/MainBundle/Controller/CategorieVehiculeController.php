<?php

namespace MainBundle\Controller;
use MainBundle\Entity\CategorieVehicule;
use MainBundle\Form\CategorieVehiculeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategorieVehiculeController extends Controller
{
    public function listeCategorieVehiculeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newCategorieVehicule = new CategorieVehicule();
        $form = $this->createForm(new CategorieVehiculeType(), $newCategorieVehicule);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $mod = $em
                    ->getRepository("MainBundle:CategorieVehicule")
                    ->findByLibelle($newCategorieVehicule->getLibelle());
                if($mod){
                    $this->get('session')->getFlashBag()->add('error', 'Cette catégorie de Véhicule existe déjà.');
                    return $this->redirect($this->generateUrl('categorie_vehicule'));
                }
                     $em->persist($newCategorieVehicule);
                     $em->flush();
                     $this->get('session')->getFlashBag()->add('success', 'categorie de Véhicule ajouté avec succès');
                     return $this->redirect($this->generateUrl('categorie_vehicule'));   
            }
        }
        $categorievehicules = $em
                ->getRepository("MainBundle:CategorieVehicule")
                ->findAll();
        
        return $this->render('MainBundle:Categorie:categorieVehicule.html.twig', array(
                    'form' => $form->createView(),
                    'categorievehicules' => $categorievehicules
        ));
    }
    
     public function modifierCategorieVehiculeAction($id) {
        $em = $this->getDoctrine()->getManager();
        $categorievehicule = $em->getRepository("MainBundle:CategorieVehicule")->find($id);
        $form = $this->createForm(new CategorieVehiculeType(), $categorievehicule);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $mod = $em
                    ->getRepository("MainBundle:CategorieVehicule")
                    ->findByLibelle($categorievehicule->getLibelle());
                if($mod){
                    $this->get('session')->getFlashBag()->add('error', 'Cette catégorie de Véhicule existe déjà.');
                    return $this->redirect($this->generateUrl('categorie_vehicule'));
                }
                $em->persist($categorievehicule);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Categorie de véhicule modifié avec succès');
                return $this->redirect($this->generateUrl('categorie_vehicule'));
            }
        }
        $categorievehicules = $em
                ->getRepository("MainBundle:CategorieVehicule")
                ->findAll();
        return $this->render('MainBundle:Categorie:categorieVehicule.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'categorievehicules' => $categorievehicules
        ));
    }
    
    public function supprimerCategorieVehiculeAction($id) {
        $em = $this->getDoctrine()->getManager();
        $categorievehicules = $em->getRepository("MainBundle:CategorieVehicule")->find($id);
        if ($categorievehicules) {
            $vehicules = $em->getRepository("MainBundle:Vehicule")->findByCategorieVehicule($categorievehicules);
            if($vehicules){
                $this->get('session')->getFlashBag()->add('error', 'Cette catégorie de véhicule est liée à des véhicules, Vous ne pouvez donc pas la supprimer!');
                return $this->redirect($this->generateUrl('categorie_vehicule'));
            }else{
                $tarifier = $em->getRepository("MainBundle:Tarifier")->findByCategorieVehicule($categorievehicules);
                if($tarifier){
                    $this->get('session')->getFlashBag()->add('error', 'Cette catégorie de véhicule est liée à une tarification, Vous ne pouvez donc pas la supprimer!');
                    return $this->redirect($this->generateUrl('categorie_vehicule'));
                }else{
                    
                    $em->remove($categorievehicules);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('success', 'Catégorie de Véhicule supprimé avec succès');
                    return $this->redirect($this->generateUrl('categorie_vehicule'));
      
                }
                } 
             } else {
            $this->get('session')->getFlashBag()->add('error', 'Cette catégorie de véhicule n\'existe plus');
            return $this->redirect($this->generateUrl('categorie_vehicule'));
        }
    }  
}
