<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\Compagnie;
use MainBundle\Form\CompagnieType;

class CompagnieController extends Controller
{
    
    public function listeCompagnieAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newCompagnie = new Compagnie();
        $form = $this->createForm(new CompagnieType(), $newCompagnie);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $compagnie = $em ->getRepository("MainBundle:Compagnie")->findByNom($newCompagnie->getNom());
                if($compagnie){
                    $this->get('session')->getFlashBag()->add('error', 'Cette compagnie existe déjà.');
                    return $this->redirect($this->generateUrl('compagnie'));
                }
                    $em->persist($newCompagnie);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('success', 'Compagnie ajouté avec succès');
                    return $this->redirect($this->generateUrl('compagnie'));   
            }
        }
        
        $compagnies = $em->getRepository("MainBundle:Compagnie")->findAll();
        
        return $this->render('MainBundle:Assurance:listeCompagnie.html.twig', array(
                'form' => $form->createView(),
                'compagnies' => $compagnies
            ));    
        
    }
    
    public function modifierCompagnieAction($id) {
        $em = $this->getDoctrine()->getManager();
        $compagnie = $em->getRepository("MainBundle:Compagnie")->find($id);
        
        $form = $this->createForm(new CompagnieType(), $compagnie);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $comp = $em ->getRepository("MainBundle:Compagnie")->findByNom($compagnie->getNom());
                if($comp){
                    $this->get('session')->getFlashBag()->add('error', 'Cette compagnie existe déjà.');
                    return $this->redirect($this->generateUrl('compagnie'));
                }
                $em->persist($compagnie);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Compagnie modifiée avec succès');
                return $this->redirect($this->generateUrl('compagnie'));
            }
        }
        $compagnies = $em->getRepository("MainBundle:Compagnie")->findAll();
        return $this->render('MainBundle:Assurance:listeCompagnie.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'compagnies' => $compagnies
        ));
    }
    
    public function supprimerCompagnieAction($id) {
        $em = $this->getDoctrine()->getManager();
        $compagnie = $em->getRepository("MainBundle:Compagnie")->find($id);
        if ($compagnie) {
            $agences = $em->getRepository("MainBundle:Agence")->findByCompagnie($compagnie);
            if($agences){
                $this->get('session')->getFlashBag()->add('error', 'Cette compagnie dispose de plusieurs agences, Vous ne pouvez donc pas la supprimer!');
                return $this->redirect($this->generateUrl('compagnie'));
            }else{
                $em->remove($compagnie);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Compagnie supprimée avec succès');
                return $this->redirect($this->generateUrl('compagnie'));
            } 
           
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Cette compagnie n\'existe plus');
            return $this->redirect($this->generateUrl('compagnie'));
        }
    }

}
