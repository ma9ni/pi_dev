<?php

namespace pi\FrontEnd\FicheDeSoinBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class f_soinType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

                ->add('observation','Symfony\Component\Form\Extension\Core\Type\TextareaType')
                ->add('medicament')
                ->add('prochainRDV',DateType::class,array('widget'=>'single_text'))
                ->add('idAnimal',EntityType::class,array(
        'class'=>'pi\FrontEnd\FicheDeSoinBundle\Entity\animal'
    ,'choice_label'=>'nom','multiple'=>false));

    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'pi\FrontEnd\FicheDeSoinBundle\Entity\f_soin'
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pi_frontend_fichedesoinbundle_f_soin';
    }


}
