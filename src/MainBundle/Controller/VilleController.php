<?php

namespace MainBundle\Controller;
use MainBundle\Entity\Ville;
use MainBundle\Form\VilleType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VilleController extends Controller
{
    public function listeVilleAction()
    {
        //Déclaration d'une varibale pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        $villes = $em->getRepository("MainBundle:Ville")->findAll();
        //Déclaration d'un objet de type Ville
        $newVille = new Ville();
        //Création du formulaire en passant l'objet Ville en paramètre
        $form = $this->createForm(new VilleType(), $newVille);
        //Requête pour vérifier si c'est un get ou post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') { //Post
            $form->bind($request);
            //Vérification si le modèle est valide
            if ($form->isValid()) {
                //Vérification de doublon
//                $qb = $em->createQueryBuilder();
//                $qb->select('a')
//                  ->from('MainBundle:Ville', 'a')
//                  ->where('a.nom = :nom')
//                  ->leftJoin('a.zoneCirculation', 'c')
//                  ->andWhere('c.libelle = :libelle')
//                  ->setParameter('nom', $form->get('nom')->getData())
//                  ->setParameter('libelle', $form->getData()->getzoneCirculation()->getlibelle());
//                  
//                $query = $qb->getQuery();
//                $verif= $query->getResult();
//                if ($verif) {
//                    $this->get('session')->getFlashBag()->add('error', 'Cette ville existe déjà.');
//                    return $this->render('MainBundle:Parametre:ville.html.twig', array(
//                        'form' => $form->createView(),
//                        'villes' => $villes
//                            )); 
//                }
                
                
               /* $Ville_doublon = $em ->getRepository("MainBundle:Ville")->findBynom($newVille->getnom());
                if($Ville_doublon){
                    $this->get('session')->getFlashBag()->add('error', 'Cette Ville existe déjà.');
                    return $this->render('MainBundle:Ville:ville.html.twig', array(
                        'form' => $form->createView(),
                        'vehicules' => $form->getData()
                            )); 
                }*/
                $ville = $em
                    ->getRepository("MainBundle:Ville")
                    ->findBy(
                        array('nom' => $newVille->getNom(), 'zoneCirculation' => $newVille->getZoneCirculation())
                    );
                if($ville){
                    $this->get('session')->getFlashBag()->add('error', 'Cette ville a été déjà enregistrée.');
                     return $this->render('MainBundle:Parametre:ville.html.twig', array(
                        'form' => $form->createView(),
                        'villes' => $villes
                            )); 
                }else{
                    //Instruction pour l'enregistrement
                    $em->persist($newVille);
                    //Mise à jour des informations
                    $em->flush();
                    //Affichage de l'information de l'enregistrement
                    $this->get('session')->getFlashBag()->add('success', 'Ville ajoutée avec succès');
                    return $this->redirect($this->generateUrl('ville'));   
                }
            }
        }else{
        //Requête pour sélectionner la liste des Villes
        //$villes = $em->getRepository("MainBundle:Ville")->findAll();
         $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('MainBundle:Ville', 'a')
          ->orderBy('a.nom', 'ASC');

        $query = $qb->getQuery();
        $listes = $query->getResult();
        
        //Retourne la vue
        return $this->render('MainBundle:Parametre:Ville.html.twig', array(
                'form' => $form->createView(),
                'villes' => $villes
            ));  
        }
    }
    
    
    
    public function modifierVilleAction($id) {
        //Déclaration d'une variable pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        $villes = $em->getRepository("MainBundle:Ville")->findAll();
        //recherche de l'objet à modifier par l'id
        $ville = $em->getRepository("MainBundle:Ville")->find($id);
        
        //Création du formulaire en passant l'objet à modifier en paramètre
        $form = $this->createForm(new VilleType(), $ville);
        //Vérification de la méthode du formulaire si c'est un get ou un post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {//Post
            //Récupération du contenu du formulaire
            $form->bind($request);
            //Vérification si le formulaire est valide
            if ($form->isValid()) {
                //Doublon
                /*$nom = $borne_inf = $form->get('nom')->getData();
                $qb = $em->createQueryBuilder();
                $qb->select('a')
                  ->from('MainBundle:Ville', 'a')
                  ->where('a.nom = :nom')
                  ->andWhere('a.id != :id')
                  ->setParameter('nom', $nom)
                  ->setParameter('id', $id);*/
//                
//                 $qb = $em->createQueryBuilder();
//                $qb->select('a')
//                  ->from('MainBundle:Ville', 'a')
//                  ->where('a.nom = :nom')
//                  ->leftJoin('a.zoneCirculation', 'c')
//                  ->andWhere('c.libelle = :libelle')
//                  ->andWhere('a.id != :id')
//                  ->setParameter('nom', $form->get('nom')->getData())
//                  ->setParameter('libelle', $form->getData()->getzoneCirculation()->getlibelle())
//                  ->setParameter('id', $id);
//                  
//                $query = $qb->getQuery();
//                $verif= $query->getResult();
//                if ($verif) {
//                    $this->get('session')->getFlashBag()->add('error', 'Cette ville existe déjà.');
//                    return $this->render('MainBundle:Parametre:ville.html.twig', array(
//                        'form' => $form->createView(),
//                        'villes' => $villes
//                            )); 
//                }
                
                 $villeUpdate = $em
                    ->getRepository("MainBundle:Ville")
                    ->findBy(
                        array('nom' => $ville->getNom(), 'zoneCirculation' => $ville->getZoneCirculation())
                    );
                 
                if($villeUpdate){
                    $this->get('session')->getFlashBag()->add('error', 'Cette ville a été déjà enregistrée.');
                   return $this->redirect($this->generateUrl('ville'));
                }else{
                    //Instruction pour modifier
                    $em->persist($ville);
                    //Mise à jour
                    $em->flush();
                    //Affichage d'un message
                    $this->get('session')->getFlashBag()->add('success', 'Ville modifiée avec succès');
                    //Rédirection
                    return $this->redirect($this->generateUrl('ville'));
                }
            }
        }else{
        //Requête pour récupérer la liste des Villes
       // $villes = $em->getRepository("MainBundle:Ville")->findAll();
       
        return $this->render('MainBundle:Parametre:Ville.html.twig', array(
                    'form' => $form->createView(),
                    'modification' => true,
                    'villes' => $villes
        ));
        }
    }
    
    
    
    public function supprimerVilleAction($id) {
        //Récupération du modèle
        $em = $this->getDoctrine()->getManager();
        //Recherche de l'objet à supprimer
        $ville = $em->getRepository("MainBundle:Ville")->find($id);
        //Tester le résultat
        if ($ville) {
            //Suppression
            $em->remove($ville);
            //Mise à jour des informations
            $em->flush();
            //Affichage de message
            $this->get('session')->getFlashBag()->add('success', 'Ville supprimée avec succès');
            //Rédirection 
            return $this->redirect($this->generateUrl('ville'));
        } else {//Objet non trouvé
            //Affichage de message
            $this->get('session')->getFlashBag()->add('error', 'Cette ville n\'existe pas');
            //Rédirection
            return $this->redirect($this->generateUrl('ville'));
        }
    }
}
