<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresse')
            ->add('gouvernorat')
            ->add('num_tel')
            ->add('roles', ChoiceType::class, array(
                'label' => 'Type',
                'choices' => array(
                    'Utilisateur' => 'ROLE_USER',
                    'Vétérinaire' => 'ROLE_VETE',
                    'Dresseur' => 'ROLE_DRESS'
                ),
                'required' => true,
                'multiple' => true,));
    }
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}
