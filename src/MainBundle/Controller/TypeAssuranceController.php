<?php

namespace MainBundle\Controller;
use MainBundle\Entity\TypeAssurance;
use MainBundle\Form\TypeAssuranceType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TypeAssuranceController extends Controller
{
    public function listeTypeAssuranceAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newTypeAssurance = new TypeAssurance();
        $form = $this->createForm(new TypeAssuranceType(), $newTypeAssurance);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $typeassurance = $em ->getRepository("MainBundle:TypeAssurance")->findByLibelle($newTypeAssurance->getLibelle());
                if($typeassurance){
                    $this->get('session')->getFlashBag()->add('error', 'Ce Type Assurance existe déjà.');
                    return $this->redirect($this->generateUrl('type_assurance'));
                }
                    $em->persist($newTypeAssurance);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('success', 'Type Assurance ajouté avec succès');
                    return $this->redirect($this->generateUrl('type_assurance'));   
            }
        }
        
        $typeassurances = $em->getRepository("MainBundle:TypeAssurance")->findAll();
        
        return $this->render('MainBundle:Parametre:TypeAssurance.html.twig', array(
                'form' => $form->createView(),
                'typeassurances' => $typeassurances
            ));    
        
    }
    
    public function modifierTypeAssuranceAction($id) {
        $em = $this->getDoctrine()->getManager();
        $typeassurance = $em->getRepository("MainBundle:TypeAssurance")->find($id);
        
        $form = $this->createForm(new TypeAssuranceType(), $typeassurance);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $type = $em ->getRepository("MainBundle:TypeAssurance")->findByLibelle($typeassurance->getLibelle());
                if($type){
                    $this->get('session')->getFlashBag()->add('error', 'Ce Type Assurance existe déjà.');
                    return $this->redirect($this->generateUrl('type_assurance'));
                }
                $em->persist($typeassurance);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Type assurance modifiée avec succès');
                return $this->redirect($this->generateUrl('type_assurance'));
            }
        }
        $typeassurances = $em->getRepository("MainBundle:TypeAssurance")->findAll();
        return $this->render('MainBundle:Parametre:TypeAssurance.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'typeassurances' => $typeassurances
        ));
    }
    
    public function supprimerTypeAssuranceAction($id) {
        $em = $this->getDoctrine()->getManager();
        $typeassurances = $em->getRepository("MainBundle:TypeAssurance")->find($id);
        if ($typeassurances) {
             $lister = $em->getRepository("MainBundle:Lister")->findByTypeAssurance($typeassurances);
            if($lister){
                $this->get('session')->getFlashBag()->add('error', 'Ce type est lié à d\'entités, Vous ne pouvez donc pas le supprimer!');
                return $this->redirect($this->generateUrl('type_assurance'));
            }else{
                $em->remove($typeassurances);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Type assurance supprimée avec succès');
                return $this->redirect($this->generateUrl('type_assurance'));
            } 
            
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Ce type assurance  n\'existe plus');
            return $this->redirect($this->generateUrl('type_assurance'));
        }
    }

}
