<?php

namespace pi\FrontEnd\FicheDeSoinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class animalType extends AbstractType
{


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('nomproprietaire')
            ->add('description')
            ->add('sexe')
            ->add('datedenaissance')
            ->add('race')
            ->add('image', FileType::class,  array(
                'label' => 'Image',
                'data_class' => null,
                'required'    => false));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'pi\FrontEnd\FicheDeSoinBundle\Entity\animal'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pi_frontend_fichedesoinbundle_animal';
    }


}
