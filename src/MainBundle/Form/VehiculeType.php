<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VehiculeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numImmat', 'text', array(
                    'label' => 'Numéro d\'Immatriclation',
                    'attr' => array(
                        'class' => 'form-control',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('datePremiereMiseCir',  'date', array(
                   'label' => 'Date Prem. mise en circu.',
                    'input' => 'datetime',
                    'widget' => 'single_text',
                    'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'JJ/MM/AAAA',
                    'style' => 'margin-bottom:25px;'
                    )
            ))
            ->add('energie', 'text', array(
                    'label' => 'Energie',
                    'attr' => array(
                        'class' => 'form-control',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('genre', 'text', array(
                    'label' => 'Genre',
                    'attr' => array(
                        'class' => 'form-control',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('carrosserie', 'text', array(
                    'label' => 'Carrosserie',
                    'attr' => array(
                        'class' => 'form-control',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('nbrePlaceHorsCabine', 'integer', array(
                    'label' => 'Nombre de Places Hors Cabine',
                    'attr' => array(
                        'class' => 'form-control',
                        'onkeypress' => 'return isNumberKey(event)',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('nbrePlaces', 'integer', array(
                    'label' => 'Nombre de Places',
                    'attr' => array(
                        'class' => 'form-control',
                        'onkeypress' => 'return isNumberKey(event)',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('puissance', 'integer', array(
                    'label' => 'Puissance',
                    'attr' => array(
                        'class' => 'form-control',
                        'onkeypress' => 'return isNumberKey(event)',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('chargeUtile', 'integer', array(
                    'label' => 'Charge Utile',
                    'attr' => array(
                        'class' => 'form-control',
                        'onkeypress' => 'return isNumberKey(event)',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('ptac', 'integer', array(
                    'label' => 'PTAC',
                    'attr' => array(
                        'class' => 'form-control',
                        'onkeypress' => 'return isNumberKey(event)',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('pv', 'integer', array(
                    'label' => 'PV',
                    'attr' => array(
                        'class' => 'form-control',
                        'onkeypress' => 'return isNumberKey(event)',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('puissanceReelle', 'integer', array(
                    'label' => 'Puissance Réelle',
                    'attr' => array(
                        'class' => 'form-control',
                        'onkeypress' => 'return isNumberKey(event)',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('numSerie', 'text', array(
                    'label' => 'Numérie Série',
                    'attr' => array(
                        'class' => 'form-control',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('numChassis', 'text', array(
                    'label' => 'Numéro Chassis',
                    'attr' => array(
                        'class' => 'form-control',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('valneu', 'integer', array(
                    'label' => 'Valeur Neuve',
                    'attr' => array(
                        'class' => 'form-control',
                        'onkeypress' => 'return isNumberKey(event)',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('valven', 'integer', array(
                    'label' => 'Valeur Vénale',
                    'attr' => array(
                        'class' => 'form-control',
                        'onkeypress' => 'return isNumberKey(event)',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('lieuGarage', 'text', array(
                    'label' => 'Lieu Garage',
                    'attr' => array(
                        'class' => 'form-control',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('gpsgsm', 'text', array(
                    'label' => 'GPS',
                    'attr' => array(
                        'class' => 'form-control',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('tarif', 'text', array(
                    'label' => 'Tarif',
                    'attr' => array(
                        'class' => 'form-control',
                        'onkeypress' => 'return isNumberKey(event)',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('condhab', 'text', array(
                    'label' => 'Conducteur Habituel',
                    'attr' => array(
                        'class' => 'form-control',
                         'style' => 'margin-bottom:25px;'
                    ),
                ))
            ->add('categorieVehicule', 'entity',  array(
                    'empty_value' => 'Choisissez une catégorie de véhicule',
                    'class' => "MainBundle:CategorieVehicule",
                    'property' => "libelle",
                    'label' => 'Catégorie Véhicule:',
                    'attr' => array(
                        'class' => 'form-control',
                         'style' => 'margin-bottom:25px;'
                    )))
            ->add('modele', 'entity',  array(
                    'empty_value' => 'Choisissez un modèle',
                    'class' => "MainBundle:Modele",
                    'property' => "nomComplet",
                    'label' => 'Modele:',
                    'attr' => array(
                        'class' => 'form-control',
                         'style' => 'margin-bottom:25px;'
                    )))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Vehicule'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mainbundle_vehicule';
    }
}
