<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VilleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text', array(
                   'label' => 'Libellé de la Ville',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
            ))
            ->add('ZoneCirculation', 'entity',  array(
                    'empty_value' => 'Choisissez la zone de circulation',
                    'class' => "MainBundle:ZoneCirculation",
                    'property' => "libelle",
                    'label' => 'Zone de Circulation:',
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
            'data_class' => 'MainBundle\Entity\Ville'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mainbundle_ville';
    }
}
