<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\Modele;
use MainBundle\Form\ModeleType;

class ModeleController extends Controller
{
    public function listeModelAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newModel = new Modele();
        $form = $this->createForm(new ModeleType(), $newModel);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $newModel->setNomComplet($newModel->getLibelle()." - ".$newModel->getMarque()->getLibelle());
                $mod = $em
                    ->getRepository("MainBundle:Modele")
                     ->findBy(
                        array('libelle' => $newModel->getLibelle(), 'marque' => $newModel->getMarque())
                    );
                if($mod){
                    $this->get('session')->getFlashBag()->add('error', 'Ce modele de Véhicule existe déjà.');
                    return $this->redirect($this->generateUrl('model'));
                }
                     $em->persist($newModel);
                     $em->flush();
                     $this->get('session')->getFlashBag()->add('success', 'Modele de Véhicule ajouté avec succès');
                     return $this->redirect($this->generateUrl('model'));   
            }
        }
        $modeles = $em
                ->getRepository("MainBundle:Modele")
                ->findAll();
        
        return $this->render('MainBundle:Automobile:model.html.twig', array(
                    'form' => $form->createView(),
                    'modeles' => $modeles
        ));
    }
    
     public function modifierModeleAction($id) {
        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository("MainBundle:Modele")->find($id);
        $form = $this->createForm(new ModeleType(), $modele);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $modele->setNomComplet($modele->getLibelle()." - ".$modele->getMarque()->getLibelle());
                
                $mod = $em
                    ->getRepository("MainBundle:Modele")
                     ->findBy(
                        array('libelle' => $modele->getLibelle(), 'marque' => $modele->getMarque())
                    );
                if($mod){
                    $this->get('session')->getFlashBag()->add('error', 'Ce modele de Véhicule existe déjà.');
                    return $this->redirect($this->generateUrl('model'));
                }
                $em->persist($modele);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Modele de véhicule modifié avec succès');
                return $this->redirect($this->generateUrl('model'));
            }
        }
        $modeles = $em
                ->getRepository("MainBundle:Modele")
                ->findAll();
        return $this->render('MainBundle:Automobile:model.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'modeles' => $modeles
        ));
    }
    
    public function supprimerModeleAction($id) {
        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository("MainBundle:Modele")->find($id);
        if ($modele) {
             $vehicules = $em->getRepository("MainBundle:Vehicule")->findByModele($modele);
            if($vehicules){
                $this->get('session')->getFlashBag()->add('error', 'Ce modèle est liée à des véhicules, Vous ne pouvez donc pas le supprimer!');
                return $this->redirect($this->generateUrl('model'));
            }else{
                $em->remove($modele);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Modele de Véhicule supprimé avec succès');
            return $this->redirect($this->generateUrl('model'));
            } 
           
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Ce modele de véhicule n\'existe plus');
            return $this->redirect($this->generateUrl('model'));
        }
    }  
}
