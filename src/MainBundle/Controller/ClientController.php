<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\Client;
use MainBundle\Form\ClientType;
class ClientController extends Controller
{
    public function listeClientAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newClient = new Client();
        $form = $this->createForm(new ClientType(), $newClient);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $client = $em ->getRepository("MainBundle:Client")->findByNom($newClient->getNom());
                if($client){
                    $this->get('session')->getFlashBag()->add('error', 'Cet client existe déjà.');
                    return $this->redirect($this->generateUrl('client'));
                }
                    $em->persist($newClient);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('success', 'client ajouté avec succès');
                    return $this->redirect($this->generateUrl('client'));   
            }
        }
        
        $clients = $em->getRepository("MainBundle:Client")->findAll();
        
        return $this->render('MainBundle:Assurance:Client.html.twig', array(
                'form' => $form->createView(),
                'clients' => $clients
            ));    
        
    }
    
    public function modifierClientAction($id) {
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository("MainBundle:Client")->find($id);
        
        $form = $this->createForm(new ClientType(), $client);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                
                $em->persist($client);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'client modifiée avec succès');
                return $this->redirect($this->generateUrl('client'));
            }
        }
        $clients = $em->getRepository("MainBundle:Client")->findAll();
        return $this->render('MainBundle:Assurance:Client.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'clients' => $clients
        ));
    }
    
    public function supprimerClientAction($id) {
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository("MainBundle:Client")->find($id);
        if ($client) {
        
            $policeAssurance = $em->getRepository("MainBundle:PoliceAssurance")->findByClient($client);
            if($policeAssurance){
                $this->get('session')->getFlashBag()->add('error', 'Cet client est lié à une police d\'assurance, Vous ne pouvez donc pas le supprimer!');
                return $this->redirect($this->generateUrl('client'));
            }else{
                $em->remove($client);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'client supprimée avec succès');
                return $this->redirect($this->generateUrl('client'));
            } 
           
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Cet client n\'existe plus');
            return $this->redirect($this->generateUrl('client'));
        }
    }
}
