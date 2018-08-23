<?php

namespace MainBundle\Controller;
use MainBundle\Entity\TarifGroupement;
use MainBundle\Form\TarifGroupementType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TarifGroupementController extends Controller
{
      public function listeTarifGroupementAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newTarif = new TarifGroupement();
        $form = $this->createForm(new TarifGroupementType(), $newTarif);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $tarif = $em
                    ->getRepository("MainBundle:TarifGroupement")
                    ->findBy(array("bornInf" => $newTarif->getBornInf(),
                                    "bornSup" => $newTarif->getBornSup()
                        ));
                if($tarif){
                    $this->get('session')->getFlashBag()->add('error', 'Ce Tarif existe déjà pour cette borne.');
                    return $this->redirect($this->generateUrl('tarifgroupement'));
                }
                if($newTarif->getBornSup() < $newTarif->getBornInf()){
                    $this->get('session')->getFlashBag()->add('error', 'La borne inférieure ne peut etre supérieure à la borne supérieure.');
                    return $this->redirect($this->generateUrl('tarifgroupement'));
                }
                     $em->persist($newTarif);
                     $em->flush();
                     $this->get('session')->getFlashBag()->add('success', 'Tarif ajouté groupement avec succès');
                     return $this->redirect($this->generateUrl('tarifgroupement'));   
            }
        }
        $tarifs = $em
                ->getRepository("MainBundle:TarifGroupement")
                ->findAll();
        
        return $this->render('MainBundle:Tarif:tarifGroupement.html.twig', array(
                    'form' => $form->createView(),
                    'tarifs' => $tarifs
        ));
    }
    
     public function modifierTarifGroupementAction($id) {
        $em = $this->getDoctrine()->getManager();
        $tarifUpdate = $em->getRepository("MainBundle:TarifGroupement")->find($id);
        $form = $this->createForm(new TarifGroupementType(), $tarifUpdate);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
//                $tarif = $em
//                    ->getRepository("MainBundle:TarifGroupement")
//                    ->findBy(array("bornInf" => $tarifUpdate->getBornInf(),
//                                    "bornSup" => $tarifUpdate->getBornSup()
//                        ));
//                if($tarif){
//                    $this->get('session')->getFlashBag()->add('error', 'Ce Tarif existe déjà pour cette borne.');
//                    return $this->redirect($this->generateUrl('tarifgroupement'));
//                }
                if($tarifUpdate->getBornSup() < $tarifUpdate->getBornInf()){
                    $this->get('session')->getFlashBag()->add('error', 'La borne inférieure ne peut etre supérieure à la borne supérieure.');
                    return $this->redirect($this->generateUrl('tarifgroupement'));
                }
                $em->persist($tarifUpdate);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Tarif groupement modifié avec succès');
                return $this->redirect($this->generateUrl('tarifgroupement'));
            }
        }
        $tarifs = $em
                ->getRepository("MainBundle:TarifGroupement")
                ->findAll();
        return $this->render('MainBundle:Tarif:tarifGroupement.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'tarifs' => $tarifs
        ));
    }
    
    public function supprimerTarifGroupementAction($id) {
        $em = $this->getDoctrine()->getManager();
        $tarif = $em->getRepository("MainBundle:TarifGroupement")->find($id);
        if ($tarif) {
            $clients = $em->getRepository("MainBundle:Client")->findByTarifGroupement($tarif);
            if($clients){
                $this->get('session')->getFlashBag()->add('error', 'Ce tarif groupement est lié à des clients, Vous ne pouvez donc pas le supprimer!');
                return $this->redirect($this->generateUrl('tarifgroupement'));
            }else{
                $em->remove($tarif);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Tarif supprimé avec succès');
            return $this->redirect($this->generateUrl('tarifgroupement'));
            } 
            
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Ce tarif n\'existe plus');
            return $this->redirect($this->generateUrl('tarifgroupement'));
        }
    }  
}
