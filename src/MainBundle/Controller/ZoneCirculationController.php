<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\ZoneCirculation;
use MainBundle\Form\ZoneCirculationType;

class ZoneCirculationController extends Controller
{
    public function listeZoneCirculationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newZone = new ZoneCirculation();
        $form = $this->createForm(new ZoneCirculationType(), $newZone);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $zone = $em
                    ->getRepository("MainBundle:ZoneCirculation")
                    ->findByLibelle($newZone->getLibelle());
                if($zone){
                    $this->get('session')->getFlashBag()->add('error', 'Cette zone circulation est déjà enregistrée.');
                    return $this->redirect($this->generateUrl('zonecirculation'));
                }
                        $em->persist($newZone);
                     $em->flush();
                     $this->get('session')->getFlashBag()->add('success', 'Zone Circulation ajoutée avec succès');
                     return $this->redirect($this->generateUrl('zonecirculation'));   
            }
        }
        $zones = $em
                ->getRepository("MainBundle:ZoneCirculation")
                ->findAll();
        
        return $this->render('MainBundle:Parametre:zoneCirculation.html.twig', array(
                    'form' => $form->createView(),
                    'zones' => $zones
        ));
    }
    
     public function modifierZoneCirculationAction($id) {
        $em = $this->getDoctrine()->getManager();
        $zone = $em->getRepository("MainBundle:ZoneCirculation")->find($id);
        $form = $this->createForm(new ZoneCirculationType(), $zone);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $zoneUpdate = $em
                    ->getRepository("MainBundle:ZoneCirculation")
                    ->findByLibelle($zone->getLibelle());
                if($zoneUpdate){
                    $this->get('session')->getFlashBag()->add('error', 'Cette zone circulation est déjà enregistrée.');
                    return $this->redirect($this->generateUrl('zonecirculation'));
                }
                $em->persist($zone);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Zone Circulation modifiée avec succès');
                return $this->redirect($this->generateUrl('zonecirculation'));
            }
        }
        $zones = $em
                ->getRepository("MainBundle:ZoneCirculation")
                ->findAll();
        return $this->render('MainBundle:Parametre:zoneCirculation.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'zones' => $zones
        ));
    }
    
    public function supprimerZoneCirculationAction($id) {
        $em = $this->getDoctrine()->getManager();
        $zone= $em->getRepository("MainBundle:ZoneCirculation")->find($id);
        if ($zone) {
            $villes = $em->getRepository("MainBundle:Ville")->findByZoneCirculation($zone);
            if($villes){
                $this->get('session')->getFlashBag()->add('error', 'Cette Zone Circulation est liée à des villes, Vous ne pouvez donc pas la supprimer!');
                return $this->redirect($this->generateUrl('zonecirculation'));
            }else{
                $tarifier = $em->getRepository("MainBundle:Tarifier")->findByZoneCirculation($zone);
                if($tarifier){
                    $this->get('session')->getFlashBag()->add('error', 'Cette Zone Circulation est liée à une tarification, Vous ne pouvez donc pas la supprimer!');
                    return $this->redirect($this->generateUrl('zonecirculation'));
                }else{
                $em->remove($zone);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Zone de circulation supprimée avec succès!');
                return $this->redirect($this->generateUrl('zonecirculation'));
            
                }
                } 
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Cette zone de circulation n\'existe plus dans la base');
            return $this->redirect($this->generateUrl('zonecirculation'));
        }
    }  
}
