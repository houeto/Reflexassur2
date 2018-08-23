<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function adminAction()
    {
        return $this->render('MainBundle:Default:admin.html.twig');
    }
    public function indexAction()
    {
        return $this->render('MainBundle:Default:index.html.twig');
    }
    
    public function assuranceautoAction()
    {
        return $this->render('MainBundle:Default:assuranceauto.html.twig');
    }
    
    public function assurancemotoAction()
    {
        return $this->render('MainBundle:Default:assurancemoto.html.twig');
    }
    
    public function assurancevoyageAction()
    {
        return $this->render('MainBundle:Default:assurancevoyage.html.twig');
    }
    
    public function contactAction()
    {
        return $this->render('MainBundle:Default:contact.html.twig');
    }
}
