<?php

namespace MainBundle\Controller;
use MainBundle\Entity\Vehicule;
use MainBundle\Form\VehiculeType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VehiculeController extends Controller
{
    public function ListeAction()
    {
        //Déclaration d'une varibale pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        
         //Déclaration d'un objet de type constituer
        $newVehicule = new Vehicule();
        //Création du formulaire en passant l'objet constituer en paramètre
        $form = $this->createForm(new VehiculeType(), $newVehicule);
        
        //Requête pour sélectionner la liste des Vehicules
        // $listes = $em->getRepository("MainBundle:Vehicule")->findAll();
        
        $qb = $em->createQueryBuilder();
        $qb->select('a')
          ->from('MainBundle:Vehicule', 'a')
          ->orderBy('a.numImmat', 'ASC');

        $query = $qb->getQuery();
        $listes = $query->getResult();
        
        
        //Retourne la vue
        return $this->render('MainBundle:Vehicule:Liste.html.twig', array(
                'form' => $form->createView(),
                'liste' => $listes
            ));    
        
    }
    
    
      public function AjoutAction()
    {
        //Déclaration d'une varibale pour récupérer le modèle
       // $em = $this->getDoctrine()->getManager();
        
         //Déclaration d'un objet de type Vehicule
        $newVehicule = new Vehicule();
        //Création du formulaire en passant l'objet constituer en paramètre
        $form = $this->createForm(new VehiculeType(), $newVehicule);
        
        //Requête pour vérifier si c'est un get ou post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') { //Post
            //Déclaration d'une varibale pour récupérer le modèle
            $em = $this->getDoctrine()->getManager();
            
            $form->bind($request);
            //Vérification si le modèle est valide
            //if ($form->isValid()) {
                //Vérification de doublon
                //Doublon immatriculation
                $immatriculation = $em
                    ->getRepository("MainBundle:Vehicule")
                    ->findBynumImmat($newVehicule->getnumImmat());
                if($immatriculation){
                    $this->get('session')->getFlashBag()->add('error', 'Cette immatriculation de Véhicule existe déjà.');
                    return $this->render('MainBundle:Vehicule:Ajout.html.twig', array(
                        'form' => $form->createView(),
                        'vehicules' =>  $form->getData(),
                               ));
                }
                
                //Doublon chassis
                $chassis = $em
                    ->getRepository("MainBundle:Vehicule")
                    ->findBynumChassis($newVehicule->getnumChassis());
                if($chassis){
                    $this->get('session')->getFlashBag()->add('error', 'Ce chassis existe déjà.');
                    return $this->render('MainBundle:Vehicule:Ajout.html.twig', array(
                        'form' => $form->createView(),
                        'vehicules' =>  $form->getData(),
                               ));
                }
                
                //Doublon numéro de série
                $serie = $em
                    ->getRepository("MainBundle:Vehicule")
                    ->findBynumSerie($newVehicule->getnumSerie());
                if($serie){
                    $this->get('session')->getFlashBag()->add('error', 'Ce numéro de série existe déjà.');
                    return $this->render('MainBundle:Vehicule:Ajout.html.twig', array(
                        'form' => $form->createView(),
                        'vehicules' =>  $form->getData(),
                               ));
                }
                
                 //Date de première mise en circulation
                $date = $form->get('datePremiereMiseCir')->getData();
                if($date > (new \DateTime('now'))){
                    $this->get('session')->getFlashBag()->add('error', 'La date de première mise en circulation ne peut être postérieure à la date d\'aujourd\'hui.');
                    return $this->render('MainBundle:Vehicule:Ajout.html.twig', array(
                        'form' => $form->createView(),
                        'vehicules' =>  $form->getData(),
                               ));
                }
                    //Instruction pour l'enregistrement
                    $em->persist($newVehicule);
                    //Mise à jour des informations
                    $em->flush();
                    //Affichage de l'information de l'enregistrement
                    $this->get('session')->getFlashBag()->add('success', 'Enregistrement effectué avec succès');
                    return $this->redirect($this->generateUrl('vehicule'));   
           // }
        }
        
        
        //Retourne la vue
        return $this->render('MainBundle:Vehicule:Ajout.html.twig', array(
                'form' => $form->createView()
            ));  
        
    }
    
    
    
    public function ModifierAction($id) {
        //Déclaration d'une variable pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        //recherche de l'objet à modifier par l'id
        $vehicule = $em->getRepository("MainBundle:Vehicule")->find($id);
        
        //Création du formulaire en passant l'objet à modifier en paramètre
        $form = $this->createForm(new VehiculeType(), $vehicule);
        //Vérification de la méthode du formulaire si c'est un get ou un post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {//Post
            //Récupération du contenu du formulaire
            $form->bind($request);
            //Vérification si le formulaire est valide
            //if ($form->isValid()) {
            //Vérification immatriculation
            
            $qb = $em->createQueryBuilder();
                $qb->select('a')
                  ->from('MainBundle:Vehicule', 'a')
                  ->where('a.numImmat = :numImmat')
                  ->andWhere('a.id != :id')
                  ->setParameter('numImmat', $form->get('numImmat')->getData())
                  ->setParameter('id', $id);
                  
                $query = $qb->getQuery();
                $immatriculation= $query->getResult();
                 if($immatriculation){
                    $this->get('session')->getFlashBag()->add('error', 'Cette immatriculation de Véhicule existe déjà.');
                    return $this->render('MainBundle:Vehicule:Modification.html.twig', array(
                        'form' => $form->createView(),
                        'vehicules' =>  $form->getData(),
                               ));
                }
                
                
                //Vérification chassis
                $qb1 = $em->createQueryBuilder();
                $qb1->select('b')
                  ->from('MainBundle:Vehicule', 'b')
                  ->where('b.numChassis = :numChassis')
                  ->andWhere('b.id != :id')
                  ->setParameter('numChassis', $form->get('numChassis')->getData())
                  ->setParameter('id', $id);
                  
                $query = $qb1->getQuery();
                $chassis= $query->getResult();
                 if($chassis){
                    $this->get('session')->getFlashBag()->add('error', 'Ce chassis existe déjà.');
                    return $this->render('MainBundle:Vehicule:Modification.html.twig', array(
                        'form' => $form->createView(),
                        'vehicules' =>  $form->getData(),
                               ));
                }
                
                
                //Vérification numéro de série
                $qb2 = $em->createQueryBuilder();
                $qb2->select('c')
                  ->from('MainBundle:Vehicule', 'c')
                  ->where('c.numSerie = :numSerie')
                  ->andWhere('c.id != :id')
                  ->setParameter('numSerie', $form->get('numSerie')->getData())
                  ->setParameter('id', $id);
                  
                $query = $qb2->getQuery();
                $serie= $query->getResult();
                 if($serie){
                    $this->get('session')->getFlashBag()->add('error', 'Ce numéro de série existe déjà.');
                    return $this->render('MainBundle:Vehicule:Modification.html.twig', array(
                        'form' => $form->createView(),
                        'vehicules' =>  $form->getData(),
                               ));
                }
                
                $date = $form->get('datePremiereMiseCir')->getData();
                if($date > (new \DateTime('now'))){
                    $this->get('session')->getFlashBag()->add('error', 'La date de première mise en circulation ne peut être postérieure à la date d\'aujourd\'hui.');
                    return $this->render('MainBundle:Vehicule:Modification.html.twig', array(
                        'form' => $form->createView(),
                        'vehicules' =>  $form->getData(),
                               ));
                }
                
                //Instruction pour modifier
                $em->persist($vehicule);
                //Mise à jour
                $em->flush();
                //Affichage d'un message
                $this->get('session')->getFlashBag()->add('success', 'Modification effectuée avec succès');
                //Rédirection
                return $this->redirect($this->generateUrl('vehicule'));
            //}
        }
        
         //Retourne la vue
        return $this->render('MainBundle:Vehicule:Modification.html.twig', array(
                'form' => $form->createView()
            ));  
    }
    
    
    
    public function SupprimerAction($id) {
        //Récupération du modèle
        $em = $this->getDoctrine()->getManager();
        //Recherche de l'objet à supprimer
        $vehicule = $em->getRepository("MainBundle:Vehicule")->find($id);
        //Tester le résultat
        if ($vehicule) {
            $constituer = $em->getRepository("MainBundle:Constituer")->findByVehicule($vehicule);
            if($constituer){
                $this->get('session')->getFlashBag()->add('error', 'Ce Véhicule est lié à d\'autres enregistrements, Vous ne pouvez donc pas le supprimer!');
                return $this->redirect($this->generateUrl('vehicule'));
            }else{
               
                //Suppression
                $em->remove($vehicule);
                //Mise à jour des informations
                $em->flush();
                //Affichage de message
                $this->get('session')->getFlashBag()->add('success', 'Suppression effectuée avec succès');
                //Rédirection 
                return $this->redirect($this->generateUrl('vehicule'));
            
            } 
          
        } else {//Objet non trouvé
            //Affichage de message
            $this->get('session')->getFlashBag()->add('error', 'Cet enregistrement n\'existe pas');
            //Rédirection
            return $this->redirect($this->generateUrl('vehicule'));
        }
    }
    
    
    
    
    
    public function DetailAction($id) {
        //Déclaration d'une variable pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        //recherche de l'objet à modifier par l'id
        $vehicule = $em->getRepository("MainBundle:Vehicule")->find($id);
        
        //Création du formulaire en passant l'objet à modifier en paramètre
        $form = $this->createForm(new VehiculeType(), $vehicule);
        
         //Retourne la vue
        return $this->render('MainBundle:Vehicule:Detail.html.twig', array(
                'form' => $form->createView()
            ));  
    }
}
