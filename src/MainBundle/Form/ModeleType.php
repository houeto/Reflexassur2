<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModeleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', 'text', array(
                   'label' => 'Libellé du modele',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
            ))
         ->add('marque', 'entity',  array(
                    'empty_value' => 'Choisissez la marque',
                    'class' => "MainBundle:Marque",
                    'property' => "libelle",
                    'label' => 'Marque:',
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
            'data_class' => 'MainBundle\Entity\Modele'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ra_mainbundle_modele';
    }
}
