<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\StatutSocioProfessionnel;
use MainBundle\Form\StatutSocioProfessionnelType;

class StatutController extends Controller
{
    public function listeStatutAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newStatut= new StatutSocioProfessionnel();
        $form = $this->createForm(new StatutSocioProfessionnelType(), $newStatut);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $statut = $em
                    ->getRepository("MainBundle:StatutSocioProfessionnel")
                    ->findByLibelle($newStatut->getLibelle());
                if($statut){
                    $this->get('session')->getFlashBag()->add('error', 'Ce Statut socio professionnel existe déjà.');
                    return $this->redirect($this->generateUrl('statut'));
                }
                     $em->persist($newStatut);
                     $em->flush();
                     $this->get('session')->getFlashBag()->add('success', 'Statut socio professionnel ajouté avec succès');
                     return $this->redirect($this->generateUrl('statut'));   
            }
        }
        $statuts = $em
                ->getRepository("MainBundle:StatutSocioProfessionnel")
                ->findAll();
        
        return $this->render('MainBundle:Parametre:statut.html.twig', array(
                    'form' => $form->createView(),
                    'statuts' => $statuts
        ));
    }
    
     public function modifierStatutAction($id) {
        $em = $this->getDoctrine()->getManager();
        $statut = $em->getRepository("MainBundle:StatutSocioProfessionnel")->find($id);
        $form = $this->createForm(new StatutSocioProfessionnelType(), $statut);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $statutUpdate = $em
                    ->getRepository("MainBundle:StatutSocioProfessionnel")
                    ->findByLibelle($statut->getLibelle());
                if($statutUpdate){
                    $this->get('session')->getFlashBag()->add('error', 'Ce Statut socio professionnel existe déjà.');
                    return $this->redirect($this->generateUrl('statut'));
                }
                $em->persist($statut);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Statut Socio Professionnel modifié avec succès');
                return $this->redirect($this->generateUrl('statut'));
            }
        }
        $statuts = $em
                ->getRepository("MainBundle:StatutSocioProfessionnel")
                ->findAll();
        return $this->render('MainBundle:Parametre:statut.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'statuts' => $statuts
        ));
    }
    
    public function supprimerStatutAction($id) {
        $em = $this->getDoctrine()->getManager();
        $statut= $em->getRepository("MainBundle:StatutSocioProfessionnel")->find($id);
        if ($statut) {
            $tarifier = $em->getRepository("MainBundle:Tarifier")->findByStatutSocioProfessionnel($statut);
            if($tarifier){
                $this->get('session')->getFlashBag()->add('error', 'Ce statut socio professionnel est lié à une tarification, Vous ne pouvez donc pas le supprimer!');
                return $this->redirect($this->generateUrl('statut'));
            }else{
                $em->remove($statut);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Statut socio professionnel supprimé avec succès');
                return $this->redirect($this->generateUrl('statut'));
            } 
            
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Ce statut socio professionnel n\'existe plus');
            return $this->redirect($this->generateUrl('statut'));
        }
    }  
}
