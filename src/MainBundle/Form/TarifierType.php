<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TarifierType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('montantBaseGarantie','integer', array(
                    'label' => 'Montant de base garantie',
                    'attr' => array(
                        'class' => 'form-control'
                        ),
                ))
            ->add('puissance_fiscale','entity', array(
                    'empty_value' => 'Choisissez la Puissance',
                    'class' => "MainBundle:PuissanceFiscale",
                    'property' => "libelle",
                    'label' => 'Puissance:',
                    'attr' => array(
                        'class' => 'form-control'
                  ),
                ))
            ->add('zone_circulation','entity', array(
                    'empty_value' => 'Choisissez la zone de circulation',
                    'class' => "MainBundle:ZoneCirculation",
                    'property' => "libelle",
                    'label' => 'zone de circulation:',
                    'attr' => array(
                        'class' => 'form-control'
                  ),
                ))
            ->add('categorie_vehicule','entity', array(
                    'empty_value' => 'Choisissez la categorie du véhicule',
                    'class' => "MainBundle:CategorieVehicule",
                    'property' => "libelle",
                    'label' => 'Categorie véhicule:',
                    'attr' => array(
                        'class' => 'form-control'
                  ),
                ))
            ->add('classe_conducteur','entity', array(
                    'empty_value' => 'Choisissez la classe conducteur',
                    'class' => "MainBundle:ClasseConducteur",
                    'property' => "libelle",
                    'label' => 'classe conducteur:',
                    'attr' => array(
                        'class' => 'form-control'
                  ),
                ))
            ->add('statutSocioProfessionnel','entity', array(
                    'empty_value' => 'Choisissez la Statut SP',
                    'class' => "MainBundle:StatutSocioProfessionnel",
                    'property' => "libelle",
                    'label' => 'Statut Socio-Professionnel:',
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
            'data_class' => 'MainBundle\Entity\Tarifier'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mainbundle_tarifier';
    }
}
