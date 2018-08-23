<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TauxAssuranceTemporaireType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bornInf', 'integer', array(
                    'label' => 'Borne inférieure',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                ))
            ->add('bornSup', 'integer', array(
                    'label' => 'Borne supérieure',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                ))
            ->add('tauxDouble', 'integer', array(
                    'label' => 'Taux',
                    'attr' => array(
                        'class' => 'form-control'
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
            'data_class' => 'MainBundle\Entity\TauxAssuranceTemporaire'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mainbundle_tauxassurancetemporaire';
    }
}
