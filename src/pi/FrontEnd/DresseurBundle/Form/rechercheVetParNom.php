<?php

namespace pi\FrontEnd\DresseurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class rechercheVetParNom extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('gouvernorat');
    }

    public function getName()
    {
        return "rechercheVetParNom";
    }

    public function configureOptions(OptionsResolver $resolver)
    {


    }

    public function getBlockPrefix()
    {
        return 'dresseur_bundlerecherche_vet_par_nom';
    }
}
