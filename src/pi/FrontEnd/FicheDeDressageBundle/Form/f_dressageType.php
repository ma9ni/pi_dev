<?php

namespace pi\FrontEnd\FicheDeDressageBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class f_dressageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('displine')
            ->add('obeissance')
            ->add('specialite')
            ->add('accompagnement')
            ->add('interception')
//            ->add('noteTotale')
            ->add('dateDebut',DateType::class,array('widget'=>'single_text'))
            ->add('dateFin',DateType::class,array('widget'=>'single_text'))
            ->add('id_animal',EntityType::class,array(
                'class'=>'pi\FrontEnd\FicheDeSoinBundle\Entity\animal'
            ,'choice_label'=>'nom','multiple'=>false));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'pi\FrontEnd\FicheDeDressageBundle\Entity\f_dressage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pi_frontend_fichededressagebundle_f_dressage';
    }


}
