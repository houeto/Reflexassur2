<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AgenceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mon', 'text', array(
                    'label' => 'Nom de l\'agence',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                ))
            ->add('adresse', 'text', array(
                    'label' => 'Adresse de l\'agence',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                ))
            ->add('telephone', 'text', array(
                    'label' => 'Téléphone de l\'agence',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                ))
            ->add('compagnie', 'entity',  array(
                    'empty_value' => 'Choisissez la Compagnie',
                    'class' => "MainBundle:Compagnie",
                    'property' => "nom",
                    'label' => 'Compagnie:',
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
            'data_class' => 'MainBundle\Entity\Agence'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ra_mainbundle_agence';
    }
}
