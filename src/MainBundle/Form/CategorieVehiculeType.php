<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategorieVehiculeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle','text', array(
                    'label' => 'Libellé Categorie véhicule',
                    'attr' => array(
                        'class' => 'form-control'
                        ),
                ))
            ->add('catFlotte','text', array(
                    'label' => 'Catégorie Flotte',
                    'attr' => array(
                        'class' => 'form-control'
                        ),
                ))
            ->add('tarif_flotte', 'entity', array(
                    'empty_value' => 'Choisissez le tarif flotte',
                    'class' => "MainBundle:TarifFlotte",
                    'property' => "taux",
                    'label' => 'Taux Tarif Flotte',
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
            'data_class' => 'MainBundle\Entity\CategorieVehicule'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mainbundle_categorievehicule';
    }
}
