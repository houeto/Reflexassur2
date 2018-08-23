<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TarifAssuranceTemporaireType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateVig',  'date', array(
                   'label' => 'Date d\'entrée en vigueur',
                    'input' => 'datetime',
                    'widget' => 'single_text',
                    'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'JJ/MM/AAAA'
                    )
            ))
            ->add('tauxAssuranceTemporaire', 'entity',  array(
                    'empty_value' => 'Choisissez le taux de l\'assurance temporaire',
                    'class' => "MainBundle:TauxAssuranceTemporaire",
                    'property' => "tauxDouble",
                    'label' => 'Taux assurance temporaire:',
                    'attr' => array(
                        'class' => 'form-control'
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
            'data_class' => 'MainBundle\Entity\TarifAssuranceTemporaire'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mainbundle_tarifassurancetemporaire';
    }
}
