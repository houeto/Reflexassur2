<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ListerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('listOblig', 'text', array(
                    'label' => 'listOblig',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                ))
            ->add('compagnie', 'entity',  array(
                    'empty_value' => 'Choisissez la compagnie',
                    'class' => "MainBundle:Compagnie",
                    'property' => "nom",
                    'label' => 'Compagnie',
                    'attr' => array(
                        'class' => 'form-control'
                    ))
                )
            ->add('typeAssurance', 'entity',  array(
                    'empty_value' => 'Choisissez le type d\'assurance',
                    'class' => "MainBundle:TypeAssurance",
                    'property' => "libelle",
                    'label' => 'Type Assurance',
                    'attr' => array(
                        'class' => 'form-control'
                    ))
                )
            ->add('garantie', 'entity',  array(
                    'empty_value' => 'Choisissez la garantie',
                    'class' => "MainBundle:Garantie",
                    'property' => "libelle",
                    'label' => 'Garantie',
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
            'data_class' => 'MainBundle\Entity\Lister'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mainbundle_lister';
    }
}
