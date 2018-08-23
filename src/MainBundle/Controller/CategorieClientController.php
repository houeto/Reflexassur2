<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MainBundle\Entity\CategorieClient;
use MainBundle\Form\CategorieClientType;

class CategorieClientController extends Controller
{
    
    public function listeCategorieClientAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newCategorieClient = new CategorieClient();
        $form = $this->createForm(new CategorieClientType(), $newCategorieClient);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $categorieclient = $em ->getRepository("MainBundle:CategorieClient")->findByLibelle($newCategorieClient->getLibelle());
                if($categorieclient){
                    $this->get('session')->getFlashBag()->add('error', 'Cette catégorie client existe déjà.');
                    return $this->redirect($this->generateUrl('categorie_client'));
                }
                    $em->persist($newCategorieClient);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('success', 'catégorie client ajouté avec succès');
                    return $this->redirect($this->generateUrl('categorie_client'));   
            }
        }
        
        $categorieclients = $em->getRepository("MainBundle:CategorieClient")->findAll();
        
        return $this->render('MainBundle:Categorie:categorieClient.html.twig', array(
                'form' => $form->createView(),
                'categories' => $categorieclients
            ));    
        
    }
    
    public function modifierCategorieClientAction($id) {
        $em = $this->getDoctrine()->getManager();
        $categorieclient = $em->getRepository("MainBundle:CategorieClient")->find($id);
        
        $form = $this->createForm(new CategorieClientType(), $categorieclient);
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                 $catclient = $em ->getRepository("MainBundle:CategorieClient")->findByLibelle($categorieclient->getLibelle());
                if($catclient){
                    $this->get('session')->getFlashBag()->add('error', 'Cette catégorie client existe déjà.');
                    return $this->redirect($this->generateUrl('categorie_client'));
                }
                $em->persist($categorieclient);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'categorie client modifiée avec succès');
                return $this->redirect($this->generateUrl('categorie_client'));
            }
        }
        $categorieclients = $em->getRepository("MainBundle:CategorieClient")->findAll();
        return $this->render('MainBundle:Categorie:categorieClient.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'categories' => $categorieclients
        ));
    }
    
    public function supprimerCategorieClientAction($id) {
        $em = $this->getDoctrine()->getManager();
        $categorieclient = $em->getRepository("MainBundle:CategorieClient")->find($id);
        if ($categorieclient) {
             $clients = $em->getRepository("MainBundle:Client")->findByCategorieClient($categorieclient);
            if($clients){
                $this->get('session')->getFlashBag()->add('error', 'Des clients sont liées à cette catégorie client, Vous ne pouvez donc pas la supprimer!');
                return $this->redirect($this->generateUrl('categorie_client'));
            }else{
                $em->remove($categorieclient);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'CategorieClient supprimée avec succès');
                return $this->redirect($this->generateUrl('categorie_client'));
            
            }
           
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Cette categorie client n\'existe plus');
            return $this->redirect($this->generateUrl('categorie_client'));
        }
    }

}
