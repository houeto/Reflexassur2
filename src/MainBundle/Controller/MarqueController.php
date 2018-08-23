<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\Marque;
use MainBundle\Form\MarqueType;
use MainBundle\Entity\Modele;
use MainBundle\Form\ModeleType;

class MarqueController extends Controller
{
    public function listeMarqueAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newMarque = new Marque();
        $form = $this->createForm(new MarqueType(), $newMarque);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $marque = $em
                    ->getRepository("MainBundle:Marque")
                    ->findByLibelle($newMarque->getLibelle());
                if($marque){
                    $this->get('session')->getFlashBag()->add('error', 'Cette marque a été déjà enregistrée.');
                    return $this->redirect($this->generateUrl('marque'));
                }
                $em->persist($newMarque);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Marque de Véhicule ajoutée avec succès.');
                return $this->redirect($this->generateUrl('marque'));
            }
        }
        $marques = $em
                ->getRepository("MainBundle:Marque")
                ->findAll();
        return $this->render('MainBundle:Automobile:marque.html.twig', array(
                    'form' => $form->createView(),
                    'marques' => $marques
        ));
    }
    
     public function modifierMarqueAction($id) {
        $em = $this->getDoctrine()->getManager();
        $marque = $em->getRepository("MainBundle:Marque")->find($id);
        $form = $this->createForm(new MarqueType(), $marque);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $marqueUpdate = $em
                    ->getRepository("MainBundle:Marque")
                    ->findByLibelle($marque->getLibelle());
                if($marqueUpdate){
                    $this->get('session')->getFlashBag()->add('error', 'Cette marque a été déjà enregistrée.');
                    return $this->redirect($this->generateUrl('marque'));
                }
                $em->persist($marque);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Marque de véhicule modifiée avec succès');
                return $this->redirect($this->generateUrl('marque'));
            }
        }
        $marques = $em
                ->getRepository("MainBundle:Marque")
                ->findAll();
        return $this->render('MainBundle:Automobile:marque.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'marques' => $marques
        ));
    }
    
    public function supprimerMarqueAction($id) {
        $em = $this->getDoctrine()->getManager();
        $marque = $em->getRepository("MainBundle:Marque")->find($id);
        if ($marque) {
            $modeles = $em->getRepository("MainBundle:Modele")->findByMarque($marque);
            if($modeles){
                $this->get('session')->getFlashBag()->add('error', 'Cette marque est liée à des modeles de véhicules, Vous ne pouvez donc pas la supprimer!');
                return $this->redirect($this->generateUrl('marque'));
            }else{
                $em->remove($marque);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Marque de Véhicule supprimée avec succès');
                return $this->redirect($this->generateUrl('marque'));
            } 
         
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Cette marque de véhicule n\'existe plus');
            return $this->redirect($this->generateUrl('marque'));
        }
    }
    
//     public function listeModelAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//        $newModel = new Modele();
//        $form = $this->createForm(new ModeleType(), $newModel);
//        $request = $this->get("request");
//        if ($request->getMethod() == 'POST') {
//            $form->bind($request);
//            if ($form->isValid()) {
//                $mod = $em
//                    ->getRepository("MainBundle:Modele")
//                    ->findByLibelle($newModel->getLibelle());
//                if($mod){
//                    $this->get('session')->getFlashBag()->add('error', 'Ce modele de Véhicule existe déjà.');
//                    return $this->redirect($this->generateUrl('model'));
//                }
//                     $em->persist($newModel);
//                     $em->flush();
//                     $this->get('session')->getFlashBag()->add('success', 'Modele de Véhicule ajouté avec succès');
//                     return $this->redirect($this->generateUrl('model'));   
//            }
//        }
//        $modeles = $em
//                ->getRepository("MainBundle:Modele")
//                ->findAll();
//        
//        return $this->render('MainBundle:Administration:model.html.twig', array(
//                    'form' => $form->createView(),
//                    'modeles' => $modeles
//        ));
//    }
//    
    
    
    
   
}
