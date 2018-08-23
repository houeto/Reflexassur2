<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\TarifFlotte;
use MainBundle\Form\TarifFlotteType;

class TarifFlotteController extends Controller
{
    public function listeTarifFlotteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newTarif = new TarifFlotte();
        $form = $this->createForm(new TarifFlotteType(), $newTarif);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $tarif = $em
                    ->getRepository("MainBundle:TarifFlotte")
                    ->findBy(array("borneInf" => $newTarif->getBorneInf(),
                                    "borneSup" => $newTarif->getBorneSup()
                        ));
                if($tarif){
                    $this->get('session')->getFlashBag()->add('error', 'Ce Tarif existe déjà pour cette borne.');
                    return $this->redirect($this->generateUrl('tarifflotte'));
                }
                if($newTarif->getBorneSup() < $newTarif->getBorneInf()){
                    $this->get('session')->getFlashBag()->add('error', 'La borne inférieure ne peut etre supérieure à la borne supérieure.');
                    return $this->redirect($this->generateUrl('tarifflotte'));
                }
                     $em->persist($newTarif);
                     $em->flush();
                     $this->get('session')->getFlashBag()->add('success', 'Tarif ajouté avec succès');
                     return $this->redirect($this->generateUrl('tarifflotte'));   
            }
        }
        $tarifs = $em
                ->getRepository("MainBundle:TarifFlotte")
                ->findAll();
        
        return $this->render('MainBundle:Tarif:tarif.html.twig', array(
                    'form' => $form->createView(),
                    'tarifs' => $tarifs
        ));
    }
    
     public function modifierTarifFlotteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $tarifUpdate = $em->getRepository("MainBundle:TarifFlotte")->find($id);
        $form = $this->createForm(new TarifFlotteType(), $tarifUpdate);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $tarif = $em
                    ->getRepository("MainBundle:TarifFlotte")
                    ->findBy(array("borneInf" => $tarifUpdate->getBorneInf(),
                                    "borneSup" => $tarifUpdate->getBorneSup()
                        ));
                if($tarif){
                    $this->get('session')->getFlashBag()->add('error', 'Ce Tarif existe déjà pour cette borne.');
                    return $this->redirect($this->generateUrl('tarifflotte'));
                }
                if($tarifUpdate->getBorneSup() < $tarifUpdate->getBorneInf()){
                    $this->get('session')->getFlashBag()->add('error', 'La borne inférieure ne peut etre supérieure à la borne supérieure.');
                    return $this->redirect($this->generateUrl('tarifflotte'));
                }
                $em->persist($tarifUpdate);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Tarif modifié avec succès');
                return $this->redirect($this->generateUrl('tarifflotte'));
            }
        }
        $tarifs = $em
                ->getRepository("MainBundle:TarifFlotte")
                ->findAll();
        return $this->render('MainBundle:Tarif:tarif.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'tarifs' => $tarifs
        ));
    }
    
    public function supprimerTarifFlotteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $tarif = $em->getRepository("MainBundle:TarifFlotte")->find($id);
        if ($tarif) {
            $categories = $em->getRepository("MainBundle:CategorieVehicule")->findByTarifFlotte($tarif);
            if($categories){
                $this->get('session')->getFlashBag()->add('error', 'Ce tarif flotte est lié à des catégories véhicules, Vous ne pouvez donc pas le supprimer!');
               
            return $this->redirect($this->generateUrl('tarifflotte'));
            }else{
                $em->remove($tarif);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Tarif supprimé avec succès');
            return $this->redirect($this->generateUrl('tarifflotte'));
            } 
            
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Ce tarif n\'existe plus');
            return $this->redirect($this->generateUrl('tarifflotte'));
        }
    }  
}
