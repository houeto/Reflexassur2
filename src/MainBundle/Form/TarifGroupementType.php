<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TarifGroupementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('bornInf', 'integer', array(
               'label' => 'Borne Inférieure',
               'attr' => array(
                   'class' => 'form-control',
                   'onkeypress' => 'return isNumberKey(event)'
               ),
           ))

            ->add('bornSup', 'integer', array(
               'label' => 'Borne Supérieure',
               'attr' => array(
                   'class' => 'form-control',
                   'onkeypress' => 'return isNumberKey(event)'
               ),
           ))

            ->add('taux', 'integer', array(
               'label' => 'Taux (%)',
               'attr' => array(
                   'class' => 'form-control',
                   'onkeypress' => 'return isNumberKey(event)'
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
            'data_class' => 'MainBundle\Entity\TarifGroupement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mainbundle_tarifgroupement';
    }
}
