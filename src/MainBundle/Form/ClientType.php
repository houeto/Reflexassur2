<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre','text', array(
                    'label' => 'Titre du client',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                        ),
                ))
            ->add('nom','text', array(
                    'label' => 'Nom Client',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                        ),
                ))
            ->add('adresse','text', array(
                    'label' => 'Adresse',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                        ),
                ))
            ->add('telephone','integer', array(
                    'label' => 'Téléphone',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                        ),
                ))
            ->add('fax','integer', array(
                    'label' => 'Fax',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                        ),
                ))
            ->add('email','email', array(
                    'label' => 'Adresse mail',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                        ),
                ))
            ->add('prof','text', array(
                    'label' => 'Profession',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                        ),
                ))
            ->add('catsosprof','text', array(
                    'label' => 'Catégorie Socio Professionnel',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                        ),
                ))
            ->add('ifu','text', array(
                    'label' => 'IFU',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                        ),
                ))
            ->add('tarif_groupement','entity', array(
                    'empty_value' => 'Choisissez le tarif groupement',
                    'class' => "MainBundle:TarifGroupement",
                    'property' => "taux",
                    'label' => 'Tarif groupement taux:',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                  ),
                ))
            ->add('categorie_client','entity', array(
                    'empty_value' => 'Choisissez la categorie du client',
                    'class' => "MainBundle:CategorieClient",
                    'property' => "libelle",
                    'label' => 'Categorie client:',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                  ),
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Client'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mainbundle_client';
    }
}
