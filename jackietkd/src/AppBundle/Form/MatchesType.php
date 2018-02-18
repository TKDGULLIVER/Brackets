<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('redscore')
            ->add('bluescore')
            ->add('matchstarttime')
            ->add('matchendtime')
            ->add('currentround')
            ->add('remainingseconds')
            ->add('roundinprogress')
            ->add('stationid')
            ->add('redfighterid')
            ->add('divisionid')
            ->add('bluefighterid')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Matches'
        ));
    }
}
