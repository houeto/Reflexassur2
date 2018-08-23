<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PoliceAssuranceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NumAven', 'text', array(
                    'label' => 'Numero avenant',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                        
                    ),
                ))
            ->add('numAssur', 'text', array(
                    'label' => 'Numéro Assurance',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                    ),
                ))                
            ->add('nomAssur', 'text', array(
                    'label' => 'nom Assurance',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                    ),
                ))
            ->add('adressAssur', 'text', array(
                    'label' => 'Adresse Assurance',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                    ),
                ))
            ->add('catAssur', 'text', array(
                    'label' => 'Catégorie Assurance',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                    ),
                ))
            ->add('mouvAssur', 'text', array(
                    'label' => 'mouv Assurance',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                    ),
                ))
            ->add('dateEffAssur', 'date', array(
                    'label' => 'Date Effet',
                     'input' => 'datetime',
                    'widget' => 'single_text',
                    'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'JJ/MM/AAAA',
                    'style' => 'margin-bottom:25px;'
                    )
                ))
            ->add('dateExpAssur', 'date', array(
                    'label' => 'Date Expiration',
                    'input' => 'datetime',
                    'widget' => 'single_text',
                    'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'JJ/MM/AAAA',
                    'style' => 'margin-bottom:25px;'
                    )
                ))
            ->add('dureeAssur', 'text', array(
                    'label' => 'Durée',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                    ),
                ))
            ->add('agence', 'entity',  array(
                    'empty_value' => 'Choisissez l\'agence',
                    'class' => "MainBundle:Agence",
                    'property' => "mon",
                    'label' => 'Agence',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                    ))
                )
            ->add('typePoliceAssurance', 'entity',  array(
                    'empty_value' => 'Choisissez le type d\'assurance',
                    'class' => "MainBundle:TypePoliceAssurance",
                    'property' => "libelle",
                    'label' => 'Type police',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                    ))
                )
            ->add('client', 'entity',  array(
                    'empty_value' => 'Choisissez le client',
                    'class' => "MainBundle:Client",
                    'property' => "nom",
                    'label' => 'Client',
                    'attr' => array(
                        'class' => 'form-control',
                        'style' => 'margin-bottom:15px;'
                    ))
                )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\PoliceAssurance'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mainbundle_policeassurance';
    }
}
