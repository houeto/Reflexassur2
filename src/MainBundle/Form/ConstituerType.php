<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConstituerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut',  'date', array(
                   'label' => 'Date début',
                    'input' => 'datetime',
                    'widget' => 'single_text',
                    'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'JJ/MM/AAAA'
                    )
            ))
            ->add('dateFin', 'date', array(
                   'label' => 'Date fin',
                    'input' => 'datetime',
                    'widget' => 'single_text',
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'JJ/MM/AAAA'
                    ),
            ))
            ->add('PoliceAssurance', 'entity',  array(
                    'empty_value' => 'Choisissez une police assurance',
                    'class' => "MainBundle:PoliceAssurance",
                    'property' => "numAssur",
                    'label' => 'Police assurance:',
                    'attr' => array(
                        'class' => 'form-control'
                    )))
            ->add('Vehicule', 'entity',  array(
                    'empty_value' => 'Choisissez un véhicule',
                    'class' => "MainBundle:Vehicule",
                    'property' => "Num_Immat",
                    'label' => 'Véhicule:',
                    'attr' => array(
                        'class' => 'form-control'
                    )))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Constituer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mainbundle_constituer';
    }
}
