<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\PuissanceFiscale;
use MainBundle\Form\PuissanceFiscaleType;

class PuissanceFiscaleController extends Controller
{
    public function listePuissanceFiscaleAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newPuissance = new PuissanceFiscale();
        $form = $this->createForm(new PuissanceFiscaleType(), $newPuissance);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $puissance = $em
                    ->getRepository("MainBundle:PuissanceFiscale")
                    ->findByLibelle($newPuissance->getLibelle());
                if($puissance){
                    $this->get('session')->getFlashBag()->add('error', 'Cette puissance fiscale existe déjà.');
                    return $this->redirect($this->generateUrl('puissancefiscale'));
                }
                     $em->persist($newPuissance);
                     $em->flush();
                     $this->get('session')->getFlashBag()->add('success', 'Puissance Fiscale ajoutée avec succès');
                     return $this->redirect($this->generateUrl('puissancefiscale'));   
            }
        }
        $puissances = $em
                ->getRepository("MainBundle:PuissanceFiscale")
                ->findAll();
        
        return $this->render('MainBundle:Assurance:puissanceFiscale.html.twig', array(
                    'form' => $form->createView(),
                    'puissances' => $puissances
        ));
    }
    
     public function modifierPuissanceFiscaleAction($id) {
        $em = $this->getDoctrine()->getManager();
        $puissance = $em->getRepository("MainBundle:PuissanceFiscale")->find($id);
        $form = $this->createForm(new PuissanceFiscaleType(), $puissance);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $puissanceUpdate = $em
                    ->getRepository("MainBundle:PuissanceFiscale")
                    ->findByLibelle($puissance->getLibelle());
                if($puissanceUpdate){
                    $this->get('session')->getFlashBag()->add('error', 'Cette puissance fiscale existe déjà.');
                    return $this->redirect($this->generateUrl('puissancefiscale'));
                }
                $em->persist($puissance);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Puissance Fiscale modifiée avec succès');
                return $this->redirect($this->generateUrl('puissancefiscale'));
            }
        }
        $puissances = $em
                ->getRepository("MainBundle:PuissanceFiscale")
                ->findAll();
        return $this->render('MainBundle:Assurance:puissanceFiscale.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'puissances' => $puissances
        ));
    }
    
    public function supprimerPuissanceFiscaleAction($id) {
        $em = $this->getDoctrine()->getManager();
        $puissance = $em->getRepository("MainBundle:PuissanceFiscale")->find($id);
        if ($puissance) {
            $tarifier = $em->getRepository("MainBundle:Tarifier")->findByPuissanceFiscale($puissance);
            if($tarifier){
                $this->get('session')->getFlashBag()->add('error', 'Cette puissance fiscale est liée à une tarification, Vous ne pouvez donc pas la supprimer!');
                return $this->redirect($this->generateUrl('puissancefiscale'));
            }else{
                $em->remove($puissance);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Puissance Fiscale supprimée avec succès');
                return $this->redirect($this->generateUrl('puissancefiscale'));
            } 
           
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Cette puissance fiscale n\'existe plus');
            return $this->redirect($this->generateUrl('puissancefiscale'));
        }
    }  
}
