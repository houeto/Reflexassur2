<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\ClasseConducteur;
use MainBundle\Form\ClasseConducteurType;

class ClasseConducteurController extends Controller
{
    public function listeClasseConducteurAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newClasse= new ClasseConducteur();
        $form = $this->createForm(new ClasseConducteurType(), $newClasse);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $classe = $em
                    ->getRepository("MainBundle:ClasseConducteur")
                    ->findByLibelle($newClasse->getLibelle());
                if($classe){
                    $this->get('session')->getFlashBag()->add('error', 'Cette classe conducteur existe déjà.');
                    return $this->redirect($this->generateUrl('classeconducteur'));
                }
                        $em->persist($newClasse);
                     $em->flush();
                     $this->get('session')->getFlashBag()->add('success', 'Classe Conducteur ajoutée avec succès');
                     return $this->redirect($this->generateUrl('classeconducteur'));   
            }
        }
        $classes = $em
                ->getRepository("MainBundle:ClasseConducteur")
                ->findAll();
        
        return $this->render('MainBundle:Automobile:classeConducteur.html.twig', array(
                    'form' => $form->createView(),
                    'classes' => $classes
        ));
    }
    
     public function modifierClasseConducteurAction($id) {
        $em = $this->getDoctrine()->getManager();
        $classe = $em->getRepository("MainBundle:ClasseConducteur")->find($id);
        $form = $this->createForm(new ClasseConducteurType(), $classe);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $classeUpdate = $em
                    ->getRepository("MainBundle:ClasseConducteur")
                    ->findByLibelle($classe->getLibelle());
                if($classeUpdate){
                    $this->get('session')->getFlashBag()->add('error', 'Cette classe conducteur existe déjà.');
                    return $this->redirect($this->generateUrl('classeconducteur'));
                }
                $em->persist($classe);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Classe Conducteur modifiée avec succès');
                return $this->redirect($this->generateUrl('classeconducteur'));
            }
        }
        $classes = $em
                ->getRepository("MainBundle:ClasseConducteur")
                ->findAll();
        return $this->render('MainBundle:Automobile:classeConducteur.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'classes' => $classes
        ));
    }
    
    public function supprimerClasseConducteurAction($id) {
        $em = $this->getDoctrine()->getManager();
        $classe= $em->getRepository("MainBundle:ClasseConducteur")->find($id);
        if ($classe) {
            $tarifier = $em->getRepository("MainBundle:Tarifier")->findByClasseConducteur($classe);
            if($tarifier){  
                $this->get('session')->getFlashBag()->add('error', 'Cette classe conducteur est liée à une tarification, Vous ne pouvez donc pas la supprimer!');
                return $this->redirect($this->generateUrl('classeconducteur'));
            }else{
                $em->remove($classe);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Classe Conducteur supprimée avec succès');
                return $this->redirect($this->generateUrl('classeconducteur'));
            } 
           
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Cette classe conducteur n\'existe plus');
            return $this->redirect($this->generateUrl('classeconducteur'));
        }
    }  
}
