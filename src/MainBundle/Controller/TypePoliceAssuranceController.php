<?php

namespace MainBundle\Controller;
use MainBundle\Entity\TypePoliceAssurance;
use MainBundle\Form\TypePoliceAssuranceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TypePoliceAssuranceController extends Controller
{
    public function listeTypePoliceAssuranceAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newTypePoliceAssurance = new TypePoliceAssurance();
        $form = $this->createForm(new TypePoliceAssuranceType(), $newTypePoliceAssurance);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $typepoliceassurance = $em ->getRepository("MainBundle:TypePoliceAssurance")->findByLibelle($newTypePoliceAssurance->getLibelle());
                if($typepoliceassurance){
                    $this->get('session')->getFlashBag()->add('error', 'Ce Type Police Assurance existe déjà.');
                    return $this->redirect($this->generateUrl('type_police_assurance'));
                }else{
                    $em->persist($newTypePoliceAssurance);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('success', 'Type police Assurance ajouté avec succès');
                    return $this->redirect($this->generateUrl('type_police_assurance'));   
            
                }   
                }
        }
        
        $typepoliceassurances = $em->getRepository("MainBundle:TypePoliceAssurance")->findAll();
        
        return $this->render('MainBundle:Assurance:TypePoliceAssurance.html.twig', array(
                'form' => $form->createView(),
                'typepoliceassurances' => $typepoliceassurances
            ));    
        
    }
    
    public function modifierTypePoliceAssuranceAction($id) {
        $em = $this->getDoctrine()->getManager();
        $typepoliceassurance = $em->getRepository("MainBundle:TypePoliceAssurance")->find($id);
        
        $form = $this->createForm(new TypePoliceAssuranceType(), $typepoliceassurance);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $type= $em ->getRepository("MainBundle:TypePoliceAssurance")->findByLibelle($typepoliceassurance->getLibelle());
                if($type){
                    $this->get('session')->getFlashBag()->add('error', 'Ce Type Police Assurance existe déjà.');
                    return $this->redirect($this->generateUrl('type_police_assurance'));
                }
                $em->persist($typepoliceassurance);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'type police assurance modifiée avec succès');
                return $this->redirect($this->generateUrl('type_police_assurance'));
            }
        }
        $typepoliceassurances = $em->getRepository("MainBundle:TypePoliceAssurance")->findAll();
        return $this->render('MainBundle:Assurance:TypePoliceAssurance.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'typepoliceassurances' => $typepoliceassurances
        ));
    }
    
    public function supprimerTypePoliceAssuranceAction($id) {
        $em = $this->getDoctrine()->getManager();
        $typepoliceassurances = $em->getRepository("MainBundle:TypePoliceAssurance")->find($id);
        if ($typepoliceassurances) {
            $polices = $em->getRepository("MainBundle:PoliceAssurance")->findByTypePoliceAssurance($typepoliceassurances);
            if($polices){
                $this->get('session')->getFlashBag()->add('error', 'Ce type est lié à plusieurs polices assurance, Vous ne pouvez donc pas le supprimer!');
                return $this->redirect($this->generateUrl('compagnie'));
            }else{
                $em->remove($typepoliceassurances);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'type police assurances supprimée avec succès');
                return $this->redirect($this->generateUrl('type_police_assurance'));
            } 
          
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Ce type police assurance  n\'existe plus');
            return $this->redirect($this->generateUrl('type_police_assurance'));
        }
    }
}
