<?php

// src/AppBundle/Form/GenderType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GenderType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'Female' => true,
                'Male' => false
            )
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
