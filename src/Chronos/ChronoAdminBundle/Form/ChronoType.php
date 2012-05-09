<?php

namespace Chronos\ChronoAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ChronoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('time', 'text', array('attr' => array('placeholder' => 'Exemple : 00"00\'00')))
            ->add('bike')
            ->add('comment')
            ->add('date', 'date', array(
                                    'widget' => 'single_text',
                                    'input' => 'datetime',
                                    'format' => 'dd/MM/yyyy',
                                    'attr' => array('class' => 'date'),
                                    )
                )
            ->add('user')
            ->add('circuit')
            ->add('weather')
            ->add('roadstate');
    }

    public function getName()
    {
        return 'chronos_chronoadminbundle_chronotype';
    }
}
