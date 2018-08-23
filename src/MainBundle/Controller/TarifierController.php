<?php

namespace MainBundle\Controller;
use MainBundle\Entity\Tarifier;
use MainBundle\Form\TarifierType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TarifierController extends Controller
{
    public function listeTarifierAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newTarifier = new Tarifier();
        $form = $this->createForm(new TarifierType(), $newTarifier);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
                if ($form->isValid()) {
            
                $tarifier = $em
                ->getRepository("MainBundle:Tarifier")
                ->findBy(
                    array('montantBaseGarantie' => $newTarifier->getMontantBaseGarantie(), 
                        'puissanceFiscale' => $newTarifier->getPuissanceFiscale(),
                        'zoneCirculation' => $newTarifier->getZoneCirculation(),
                        'categorieVehicule' => $newTarifier->getCategorieVehicule(),
                        'classeConducteur' => $newTarifier->getClasseConducteur(),
                        'statutSocioProfessionnel' => $newTarifier->getStatutSocioProfessionnel()
                        )
                );
                if($tarifier){
                    $this->get('session')->getFlashBag()->add('error', 'Cette tarification a été déjà enregistrée.');
                    return $this->redirect($this->generateUrl('tarifier'));
                }
                    $em->persist($newTarifier);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('success', 'Tarification ajoutée avec succès');
                    return $this->redirect($this->generateUrl('tarifier'));   
            
        }
        }else{
            $tarifiers = $em->getRepository("MainBundle:Tarifier")->findAll();
        
            return $this->render('MainBundle:Actions:Tarifier.html.twig', array(
                    'form' => $form->createView(),
                    'tarifiers' => $tarifiers
                ));   
        }
        
         
        
    }
    
    public function modifierTarifierAction($id) {
        $em = $this->getDoctrine()->getManager();
        $tarifierUpdate = $em->getRepository("MainBundle:Tarifier")->find($id);
        
        $form = $this->createForm(new TarifierType(), $tarifierUpdate);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $tarifier = $em
                ->getRepository("MainBundle:Tarifier")
                ->findBy(
                    array('montantBaseGarantie' => $tarifierUpdate->getMontantBaseGarantie(), 
                        'puissanceFiscale' => $tarifierUpdate->getPuissanceFiscale(),
                        'zoneCirculation' => $tarifierUpdate->getZoneCirculation(),
                        'categorieVehicule' => $tarifierUpdate->getCategorieVehicule(),
                        'classeConducteur' => $tarifierUpdate->getClasseConducteur(),
                        'statutSocioProfessionnel' => $tarifierUpdate->getStatutSocioProfessionnel()
                        )
                );
                if($tarifier){
                    $this->get('session')->getFlashBag()->add('error', 'Cette tarification a été déjà enregistrée.');
                    return $this->redirect($this->generateUrl('tarifier'));
                }
                $em->persist($tarifierUpdate);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Tarification modifiée avec succès');
                return $this->redirect($this->generateUrl('tarifier'));
            }
        }
        $tarifiers = $em->getRepository("MainBundle:Tarifier")->findAll();
        return $this->render('MainBundle:Actions:Tarifier.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'tarifiers' => $tarifiers
        ));
    }
    
    public function supprimerTarifierAction($id) {
        $em = $this->getDoctrine()->getManager();
        $tarifier = $em->getRepository("MainBundle:Tarifier")->find($id);
        if ($tarifier) {
            $em->remove($tarifier);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Tarification supprimée avec succès');
            return $this->redirect($this->generateUrl('tarifier'));
        } else {
            $this->get('session')->getFlashBag()->add('error', ' cette tarification n\'existe plus');
            return $this->redirect($this->generateUrl('tarifier'));
        }
    }
}
