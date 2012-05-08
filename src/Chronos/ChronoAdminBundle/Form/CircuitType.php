<?php

namespace Chronos\ChronoAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CircuitType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('length')
            ->add('file')
            ->add('country')
        ;
    }

    public function getName()
    {
        return 'chronos_chronoadminbundle_circuittype';
    }
}
