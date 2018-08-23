<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClasseConducteurType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', 'text', array(
                    'label' => 'Libellé',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                ))
            ->add('description', 'textarea', array(
                    'required'   => false,
                    'label' => 'Description',
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
            'data_class' => 'MainBundle\Entity\ClasseConducteur'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mainbundle_classeconducteur';
    }
}
