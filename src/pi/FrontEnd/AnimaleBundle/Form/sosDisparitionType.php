<?php

namespace pi\FrontEnd\AnimaleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class sosDisparitionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomproprietaire')
            ->add('description')
            ->add('date')
            ->add('race')
            ->add('num_tel')
            ->add('lieu')
            ->add('adresse')
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
            'data_class' => 'pi\FrontEnd\AnimaleBundle\Entity\sosDisparition'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pi_frontend_animalebundle_sosdisparition';
    }


}
