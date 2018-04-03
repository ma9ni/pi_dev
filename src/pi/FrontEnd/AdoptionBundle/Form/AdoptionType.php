<?php

namespace pi\FrontEnd\AdoptionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdoptionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idMembre')->add('type')->add('dateannonce')->add('lieu')->add('etatadoption')->add('description')->add('idAnimal');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'pi\FrontEnd\AdoptionBundle\Entity\Adoption'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pi_frontend_adoptionbundle_adoption';
    }


}
