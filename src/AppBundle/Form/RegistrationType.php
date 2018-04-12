<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Gregwar\CaptchaBundle\Type\CaptchaType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('num_tel')
            ->add('gouvernorat', ChoiceType::class, array(
                'choices' => array(
                    'Tunis' => 'Tunis',
                    'Ariana' => 'Ariana',
                    'Ben Arous' => 'Ben Arous',
                    'Manouba' => 'Manouba',
                    'Nabeul' => 'Nabeul',
                    'Bizerte' => 'Bizerte',
                    'Sousse' => 'Sousse',
                    'Sfax' => 'Sfax',
                    'Monastir' => 'Monastir',
                    'Mahdia' => 'Mahdia',
                    'Gabès' => 'Gabès',
                    'Zaghouane' => 'Zaghouane',
                    'Jendouba' => 'Jendouba',
                    'Beja' => 'Beja',
                    'Le Kef' => 'Le kef',
                    'Siliana' => 'Siliana',
                    'Kairouan' => 'Kairouan',
                    'Sidi Bouzid' => 'Sidi Bouzid',
                    'Gafsa' => 'Gafsa',
                    'Kasserine' => 'Kasserine',
                    'Tozeur' => 'Tozeur',
                    'Médenine' => 'Médenine',
                    'Kébili' => 'Kébili',
                    'Tataouine' => 'Tataouine'),
                'required' => true,
                'multiple' => false,))
            ->add('adresse')
            ->add('roles', ChoiceType::class, array(
                'label' => 'Type',
                'choices' => array(
                    'Utilisateur' => 'ROLE_USER',
                    'Vétérinaire' => 'ROLE_VETE',
                    'Dresseur' => 'ROLE_DRESS',
                    'Petiteur' => 'ROLE_PET'
                ),
                'required' => true,
                'multiple' => true,))->add('image', FileType::class, array('label' => 'Image(JPG)'))
            ->add('captcha', CaptchaType::class, array(
                'width' => 200,
                'height' => 50,
                'length' => 6,
            ));
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
