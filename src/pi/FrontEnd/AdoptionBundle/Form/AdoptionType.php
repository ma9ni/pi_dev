<?php

namespace pi\FrontEnd\AdoptionBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdoptionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, array(
                'choices'  => array(
                    'Donner definitivement votre animal ' => "donner",
                    'garder temporairement votre animal' => "deleger",
                ),
            ))
            ->add('lieu')
            ->add('description')
            ->add('idAnimal',EntityType::class,array(
                'class'=>'pi\FrontEnd\FicheDeSoinBundle\Entity\animal'
            ,'choice_label'=>'nom','multiple'=>false));
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
