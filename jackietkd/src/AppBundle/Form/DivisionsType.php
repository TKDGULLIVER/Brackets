<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DivisionsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('numrounds')
            ->add('roundduration')
            ->add('breakduration')
            ->add('gender', GenderType::class)
            ->add('lowerage')
            ->add('upperage')
            ->add('lowerweight')
            ->add('upperweight')
            ->add('upperrankid')
            ->add('lowerrankid')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Divisions'
        ));
    }
}
