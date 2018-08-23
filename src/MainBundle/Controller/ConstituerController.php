<?php

namespace MainBundle\Controller;
use MainBundle\Entity\Constituer;
use MainBundle\Form\ConstituerType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConstituerController extends Controller
{
    public function ListeAction()
    {
        //Déclaration d'une varibale pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        
         //Déclaration d'un objet de type constituer
        $newConstituer = new Constituer();
        //Création du formulaire en passant l'objet constituer en paramètre
        $form = $this->createForm(new ConstituerType(), $newConstituer);
        
        //Requête pour sélectionner la liste des constituer
        $listes = $em->getRepository("MainBundle:Constituer")->findAll();
        //Retourne la vue
        return $this->render('MainBundle:Constituer:Liste.html.twig', array(
                'form' => $form->createView(),
                'constituer' => $listes
            ));    
        
    }
    
    
      public function AjoutAction()
    {
        //Déclaration d'une varibale pour récupérer le modèle
       // $em = $this->getDoctrine()->getManager();
        
         //Déclaration d'un objet de type constituer
        $newConstituer = new Constituer();
        //Création du formulaire en passant l'objet constituer en paramètre
        $form = $this->createForm(new ConstituerType(), $newConstituer);
        
        //Requête pour vérifier si c'est un get ou post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') { //Post
            //Déclaration d'une varibale pour récupérer le modèle
            $em = $this->getDoctrine()->getManager();
            
            $form->bind($request);
            //Vérification si le modèle est valide
            if ($form->isValid()) {
                $date_deb = $form->get('dateDebut')->getData();
                $date_fin = $form->get('dateFin')->getData();
                if ($date_deb  > $date_fin) {
                    $this->get('session')->getFlashBag()->add('error', 'La date début ne peut être postérieure à la date fin');
                       return $this->render('MainBundle:Constituer:Ajout.html.twig', array(
                        'form' => $form->createView(),
                        'constituers' => $form->getData()
                    ));    
                }
                //Vérification de doublon
                $qb = $em->createQueryBuilder();
                $qb->select('a')
                  ->from('MainBundle:Constituer', 'a')
                  ->where('a.dateDebut = :dateDebut')
                  ->leftJoin('a.policeAssurance', 'c')
                  ->leftJoin('a.vehicule', 'd')
                  ->andWhere('a.dateFin = :dateFin')
                  ->andWhere('c.numAssur = :numAssur')
                  ->andWhere('d.numImmat = :Num_Immat')
                  ->setParameter('dateDebut', $form->get('dateDebut')->getData())
                  ->setParameter('dateFin', $form->get('dateFin')->getData())
                  ->setParameter('numAssur', $form->getData()->getpoliceAssurance()->getnumAssur())
                  ->setParameter('Num_Immat', $form->getData()->getvehicule()->getnumImmat());
                  
                $query = $qb->getQuery();
                $doublon= $query->getResult();
                if($doublon){
                    $this->get('session')->getFlashBag()->add('error', 'Cet enregistrement existe déjà.');
                       return $this->render('MainBundle:Constituer:Ajout.html.twig', array(
                        'form' => $form->createView(),
                        'constituers' => $form->getData()
                               ));
                } 
                
                
                //Vérification de doublon
                $qb = $em->createQueryBuilder();
                $qb->select('a')
                  ->from('MainBundle:Constituer', 'a')
                  ->where('a.dateDebut = :dateDebut')
                  ->leftJoin('a.policeAssurance', 'c')
                  ->leftJoin('a.vehicule', 'd')
                  ->andWhere('a.dateFin = :dateFin')
                  ->andWhere('c.numAssur = :numAssur')
                  ->andWhere('d.numImmat = :Num_Immat')
                  ->setParameter('dateDebut', $form->get('dateDebut')->getData())
                  ->setParameter('dateFin', $form->get('dateFin')->getData())
                  ->setParameter('numAssur', $form->getData()->getpoliceAssurance()->getnumAssur())
                  ->setParameter('Num_Immat', $form->getData()->getvehicule()->getnumImmat());
                  
                $query = $qb->getQuery();
                $doublon= $query->getResult();
                if($doublon){
                    $this->get('session')->getFlashBag()->add('error', 'Cet enregistrement existe déjà.');
                       return $this->render('MainBundle:Constituer:Ajout.html.twig', array(
                        'form' => $form->createView(),
                        'constituers' => $form->getData()
                               ));
                } 
                    //Instruction pour l'enregistrement
                    $em->persist($newConstituer);
                    //Mise à jour des informations
                    $em->flush();
                    //Affichage de l'information de l'enregistrement
                    $this->get('session')->getFlashBag()->add('success', 'Enregistrement effectué avec succès');
                    return $this->redirect($this->generateUrl('constituer'));   
            }
        }
        
        
        //Retourne la vue
        return $this->render('MainBundle:Constituer:Ajout.html.twig', array(
                'form' => $form->createView()
            ));  
        
    }
    
    
    
    public function ModifierAction($id) {
        //Déclaration d'une variable pour récupérer le modèle
        $em = $this->getDoctrine()->getManager();
        //recherche de l'objet à modifier par l'id
        $constituer = $em->getRepository("MainBundle:Constituer")->find($id);
        
        //Création du formulaire en passant l'objet à modifier en paramètre
        $form = $this->createForm(new ConstituerType(), $constituer);
        //Vérification de la méthode du formulaire si c'est un get ou un post
        $request = $this->get("request");
        if ($request->getMethod() == 'POST') {//Post
            //Récupération du contenu du formulaire
            $form->bind($request);
            //Vérification si le formulaire est valide
            if ($form->isValid()) {
                $date_deb = $form->get('dateDebut')->getData();
                $date_fin = $form->get('dateFin')->getData();
                if ($date_deb  > $date_fin) {
                    $this->get('session')->getFlashBag()->add('error', 'La date début ne peut être postérieure à la date fin');
                       return $this->render('MainBundle:Constituer:Ajout.html.twig', array(
                        'form' => $form->createView(),
                        'constituers' => $form->getData()
                    ));    
                }
                //Vérification de doublon
               /*$doublon = $em 
                        ->getRepository("MainBundle:Constituer")
                        ->findBy(
                        array('dateDebut' => $newConstituer->getdateDebut(),'dateFin' => $newConstituer->getdateFin(),'numAssur' => $newConstituer->getPoliceAssurance(),'Num_Immat' => $newConstituer->getVehicule()));*/
                $qb = $em->createQueryBuilder();
                $qb->select('a')
                  ->from('MainBundle:Constituer', 'a')
                  ->where('a.dateDebut = :dateDebut')
                  ->leftJoin('a.policeAssurance', 'c')
                  ->leftJoin('a.vehicule', 'd')
                  ->andWhere('a.dateFin = :dateFin')
                  ->andWhere('c.numAssur = :numAssur')
                  ->andWhere('d.numImmat = :Num_Immat')
                  ->andWhere('a.id != :id')
                  ->setParameter('dateDebut', $form->get('dateDebut')->getData())
                  ->setParameter('dateFin', $form->get('dateFin')->getData())
                  ->setParameter('numAssur', $form->getData()->getpoliceAssurance()->getnumAssur())
                  ->setParameter('Num_Immat', $form->getData()->getvehicule()->getnumImmat())
                  ->setParameter('id', $id);
                  
                $query = $qb->getQuery();
                $doublon= $query->getResult();
                if($doublon){
                    $this->get('session')->getFlashBag()->add('error', 'Cet enregistrement existe déjà.');
                       return $this->render('MainBundle:Constituer:Ajout.html.twig', array(
                        'form' => $form->createView(),
                        'constituers' => $form->getData()
                               ));
                } 
                
                //Instruction pour modifier
                $em->persist($constituer);
                //Mise à jour
                $em->flush();
                //Affichage d'un message
                $this->get('session')->getFlashBag()->add('success', 'Modification effectuée avec succès');
                //Rédirection
                return $this->redirect($this->generateUrl('constituer'));
            }
        }
        
         //Retourne la vue
        return $this->render('MainBundle:Constituer:Modification.html.twig', array(
                'form' => $form->createView()
            ));  
    }
    
    
    
    public function SupprimerAction($id) {
        //Récupération du modèle
        $em = $this->getDoctrine()->getManager();
        //Recherche de l'objet à supprimer
        $constituer = $em->getRepository("MainBundle:Constituer")->find($id);
        //Tester le résultat
        if ($constituer) {
            //Suppression
            $em->remove($constituer);
            //Mise à jour des informations
            $em->flush();
            //Affichage de message
            $this->get('session')->getFlashBag()->add('success', 'Suppression effectuée avec succès');
            //Rédirection 
            return $this->redirect($this->generateUrl('constituer'));
        } else {//Objet non trouvé
            //Affichage de message
            $this->get('session')->getFlashBag()->add('error', 'Cet enregistrement n\'existe pas');
            //Rédirection
            return $this->redirect($this->generateUrl('constituer'));
        }
    }
}
