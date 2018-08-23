<?php

namespace MainBundle\Controller;
use MainBundle\Entity\Garantie;
use MainBundle\Form\GarantieType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GarantieController extends Controller
{
    public function listeGarantieAction()
    {
        //Déclaration d'une varibale pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        
        //Déclaration d'un objet de type garantie
        $newGarantie = new Garantie();
        //Création du formulaire en passant l'objet garantie en paramètre
        $form = $this->createForm(new GarantieType(), $newGarantie);
        //Requête pour vérifier si c'est un get ou post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') { //Post
            $form->bind($request);
            //Vérification si le modèle est valide
            if ($form->isValid()) {
                //Vérification de doublon
                //Doublon sur le nom de la garantie
                $Garantie_doublon = $em ->getRepository("MainBundle:Garantie")->findByLibelle($newGarantie->getLibelle());
                if($Garantie_doublon){
                   // $libelle = $Garantie_doublon['Libelle']->getData();
                    $this->get('session')->getFlashBag()->add('error', 'Cette garantie existe déjà.');
                    //return $this->redirect($this->generateUrl('garantie'));
                      return $this->render('MainBundle:Assurance:Garantie.html.twig', array(
                        'form' => $form->createView(),
                        'garanties' => $Garantie_doublon
                    )); 
                }
                
                    //Instruction pour l'enregistrement
                    $em->persist($newGarantie);
                    //Mise à jour des informations
                    $em->flush();
                    //Affichage de l'information de l'enregistrement
                    $this->get('session')->getFlashBag()->add('success', 'Garantie ajoutée avec succès');
                    return $this->redirect($this->generateUrl('garantie'));   
            }
        }
        //Requête pour sélectionner la liste des Garanties
        //$garanties = $em->getRepository("MainBundle:Garantie")->findAll();
        
//        $qb = $em->createQueryBuilder();
//        $qb->select('a')
//          ->from('MainBundle:Garantie', 'a')
//          ->orderBy('a.libelle', 'ASC');
//
//        $query = $qb->getQuery();
//        $listes = $query->getResult();
        
        $garanties = $em
                ->getRepository("MainBundle:Garantie")
                ->findAll();
        //Retourne la vue
        return $this->render('MainBundle:Assurance:Garantie.html.twig', array(
                'form' => $form->createView(),
                'garanties' => $garanties
            ));    
        
    }
    
    
    
    public function modifierGarantieAction($id) {
        //Déclaration d'une variable pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        //recherche de l'objet à modifier par l'id
        $garantie = $em->getRepository("MainBundle:Garantie")->find($id);
        $garanties = $em->getRepository("MainBundle:Garantie")->findAll();
        //Création du formulaire en passant l'objet à modifier en paramètre
        $form = $this->createForm(new GarantieType(), $garantie);
        //Vérification de la méthode du formulaire si c'est un get ou un post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {//Post
            //Récupération du contenu du formulaire
            $form->bind($request);
            //Vérification si le formulaire est valide
            if ($form->isValid()) {
                //Doublon
                //$libelle = $borne_inf = $form->get('libelle')->getData();
                $qb = $em->createQueryBuilder();
                $qb->select('a')
                  ->from('MainBundle:Garantie', 'a')
                  ->where('a.libelle = :libelle')
                  ->andWhere('a.id != :id')
                  ->setParameter('libelle', $form->get('libelle')->getData())
                  ->setParameter('id', $id);
                  
                $query = $qb->getQuery();
                $verif= $query->getResult();
                if ($verif) {
                    $this->get('session')->getFlashBag()->add('error', 'Cette garantie existe déjà.');
                   return $this->redirect($this->generateUrl('garantie'));
                }
                //Instruction pour modifier
                $em->persist($garantie);
                //Mise à jour
                $em->flush();
                //Affichage d'un message
                $this->get('session')->getFlashBag()->add('success', 'Garantie modifiée avec succès');
                //Rédirection
                return $this->redirect($this->generateUrl('garantie'));
            }
        }
        //Requête pour récupérer la liste des Garanties
        
        return $this->render('MainBundle:Assurance:Garantie.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'garanties' => $garanties
        ));
    }
    
    
    
    public function supprimerGarantieAction($id) {
        //Récupération du modèle
        $em = $this->getDoctrine()->getManager();
        //Recherche de l'objet à supprimer
        $garantie = $em->getRepository("MainBundle:Garantie")->find($id);
        //Tester le résultat
        if ($garantie) {
            //Contrainte d'intégrité
                $qb = $em->createQueryBuilder();
                $qb->select('a')
                  ->from('MainBundle:Lister', 'a')
                  ->leftJoin('a.garantie', 'c')
                  ->where('c.id = :id')
                  ->setParameter('id', $id);
                  
                $query = $qb->getQuery();
                $verif= $query->getResult();
                 if ($verif) {
                    $this->get('session')->getFlashBag()->add('error', 'Suppression impossible, Contrainte d\'intégrité.');
                    //Rédirection 
                     return $this->redirect($this->generateUrl('garantie')); 
                }
            //Suppression
            $em->remove($garantie);
            //Mise à jour des informations
            $em->flush();
            //Affichage de message
            $this->get('session')->getFlashBag()->add('success', 'Garantie supprimée avec succès');
            //Rédirection 
            return $this->redirect($this->generateUrl('garantie'));
        } else {//Objet non trouvé
            //Affichage de message
            $this->get('session')->getFlashBag()->add('error', 'Cette garantie n\'existe pas');
            //Rédirection
            return $this->redirect($this->generateUrl('garantie'));
        }
    }
}
