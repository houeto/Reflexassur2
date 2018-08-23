<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TarifFlotteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('borneInf', 'integer', array(
                    'label' => 'Borne Inférieure',
                    'attr' => array(
                        'class' => 'form-control col-md-4 col-sm-4'
                    ),
                ))
            ->add('borneSup', 'integer', array(
                    'label' => 'Borne Supérieure',
                    'attr' => array(
                        'class' => 'form-control col-md-4 col-sm-4'
                    ),
                ))
            ->add('taux', 'integer', array(
                    'label' => 'Taux',
                    'attr' => array(
                        'class' => 'form-control col-md-4 col-sm-4'
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
            'data_class' => 'MainBundle\Entity\TarifFlotte'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mainbundle_tarifflotte';
    }
}
